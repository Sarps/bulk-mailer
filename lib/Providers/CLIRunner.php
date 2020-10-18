<?php


namespace Sarps\Providers;


use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;
use Weevers\Path\Path;
use Jawira\CaseConverter\Convert;

class CLIRunner extends CLI
{
    protected $appDirectory;
    protected $templateDirectory;
    /**
     * @var string
     */
    private $routeFile;

    public function __construct()
    {
        parent::__construct();
        $this->appDirectory = Path::resolve(ROOT, 'src/app');
        $this->templateDirectory = Path::resolve(ROOT, 'lib/Templates');
        $this->routeFile = Path::resolve(ROOT, 'src/routes.php');
    }

    protected function setup(Options $options)
    {
        $options->setHelp('A very minimal example that does nothing but print a version');
        $options->registerOption('version', 'print version', 'v');

        $options->registerCommand('make', 'Scaffold a new mailer app');
        $options->registerArgument('class', 'The name of the new app to scaffold.', true, 'make');

        $options->registerCommand('run', 'Run an existing mailer app');
        $options->registerArgument('class', 'The name of the app to run', true, 'run');
        $options->registerOption('bulk', 'Send email to all users in "$address" or as provided by "getAddress($index)"', 'b', null, 'run');
        $options->registerOption('mail', 'Mail address to send to. Ignored if -b flag is set.', 'm', 'mail', 'run');
    }

    protected function main(Options $options)
    {
        if ($options->getOpt('version')) {
            return $this->info('1.0.0');
        }
        switch ($options->getCmd()) {
            case 'make':
                $this->makeCommand($options);
                break;
            case 'run':
                $this->runCommand($options);
                break;
            default:
                $this->error('No known command was called, we show the default help instead:');
                echo $options->help();
                exit;
        }

    }

    protected function makeCommand(Options $options)
    {
        $args = $options->getArgs();
        foreach ($args as $arg) {
            $project = $this->generateProjectName($arg);
            $view = $this->generateViewName($project);
            $projectDirectory = Path::resolve($this->appDirectory, $project);

            if (is_dir($projectDirectory)) {
                $this->error("App '{$project}' already exists");
                continue;
            }
            $this->setupProjectDirectory($projectDirectory);
            // Scaffold the mailer
            $this->copyTemplate(
                Path::resolve($this->templateDirectory, "AppTemplate.php"),
                Path::resolve($projectDirectory, "{$project}.php"),
                array('AppTemplate' => $project, 'ViewName' => $view)
            );
            // Scaffold the logger
            $this->copyTemplate(
                Path::resolve($this->templateDirectory, "LoggerTemplate.php"),
                Path::resolve($projectDirectory, "{$project}Logger.php"),
                array('LoggerTemplate' => $project)
            );
            // Scaffold the view
            $this->copyTemplate(
                Path::resolve($this->templateDirectory, "view_template.php"),
                Path::resolve($projectDirectory, "views/{$view}.php"),
                array('AppClass' => $project)
            );
            // Add Route
            $this->addRoute($project, $view);
            $this->success("'{$project}' app scaffolded successfully");
        }
    }

    public function runCommand(Options $options)
    {
        $arg = $options->getArgs();
        if (count($arg) > 1) {
            $this->error("You cannot execute multiple apps simultaneously: " . implode($arg, ','));
            return;
        }
        $arg = $arg[0];

        $className = "App\\Mailer\\{$arg}";
        if (!class_exists($className)) {
            $this->error("App '{$arg}' not found");
            return;
        }

        $app = new $className();
        if ($options->getOpt('bulk')) {
            return $app->sendBulkMail();
        }
        $mail = $options->getOpt('mail');
        if ($mail) {
            return $app->sendMail($mail);
        }

    }

    private function copyTemplate($src, $dest, $replaceMap = array())
    {
        $fp = fopen($dest, 'w+') or die();
        $contents = file_get_contents($src);
        foreach ($replaceMap as $key => $value) {
            $contents = str_replace($key, $value, $contents);
        }
        fwrite($fp, $contents);
        fclose($fp);
        $this->info("Created file {$dest}");
    }

    private function addRoute($project, $view)
    {
        file_put_contents($this->routeFile, "Route::{$project}('{$view}');\n\n", FILE_APPEND);
        $this->info("Added route /{$view} => {$project}");
    }

    private function setupProjectDirectory($directory)
    {
        if (!is_dir("{$directory}/views")) {
            mkdir("{$directory}/views", 0777, true);
        }
    }

    private function generateProjectName($className)
    {
        $hero = new Convert($className);
        return $hero->toPascal();
    }

    private function generateViewName($className)
    {
        $hero = new Convert($className);
        return $hero->toKebab();
    }

}