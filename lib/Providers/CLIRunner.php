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


}