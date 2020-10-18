<?php


namespace Sarps\Providers;


use Jawira\CaseConverter\Convert;
use Sarps\MailRequest;
use splitbrain\phpcli\Options;
use Weevers\Path\Path;

class AppRunner
{

    /**
     * @var string
     */
    private $appDirectory;
    /**
     * @var string
     */
    private $templateDirectory;
    /**
     * @var string
     */
    private $routeFile;

    public function __construct()
    {
        $this->appDirectory = Path::resolve(ROOT, 'src/app');
        $this->templateDirectory = Path::resolve(ROOT, 'lib/Templates');
        $this->routeFile = Path::resolve(ROOT, 'src/routes.php');
    }

    /**
     * @param string $arg
     */
    protected function make($arg)
    {
        $project = $this->generateProjectName($arg);
        $view = $this->generateViewName($project);
        $projectDirectory = Path::resolve($this->appDirectory, $project);

        if (is_dir($projectDirectory)) {
            $this->error("App '{$project}' already exists");
            return;
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

    /**
     * @param string $arg
     * @param array $data
     */
    public function run($arg, array $data)
    {
        $project = $this->generateProjectName($arg);
        $className = "App\\{$project}\\{$project}";
        if (!class_exists($className)) {
            $this->error("App '{$arg}' not found");
            return;
        }
        $app = new $className();
        $app->request = new MailRequest($data);
        return $app->sendMail();
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