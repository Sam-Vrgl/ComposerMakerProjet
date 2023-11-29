<?php
echo "<?php\n";
?>

namespace App\Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log {
    private $logger;
    private $path;

    public function __construct() {
        $this->logger = new Logger('my_logger');
        $this->logger->pushHandler(new StreamHandler(__DIR__.'/../logs/app.log', Logger::DEBUG));
    }

    public function info($message) {
        $this->logger->info($message);
    }

    public function warning($message) {
        $this->logger->warning($message);
    }

    public function error($message) {
        $this->logger->error($message);
    }

    public function askPath() {
        $this->path = readline("Please enter the path to your composer.json file: ");
    }

    public function checkComposer() {
        $this->askPath();
        $this->info("Checking if (file_exists($this->path)) ");

        if (file_exists($this->path)) {

            $composer = json_decode(file_get_contents($this->path), true);
            if (isset($composer['name'])) {
                echo "The name of your project is: ".$composer['name']."\n";
                $this->info("The name of your project is: ".$composer['name']."\n");
            } else {
                echo "The name of your project is not defined\n";
                $this->error("The name of your project is not defined\n");
            }
            if (isset($composer['description'])) {
                echo "The description of your project is: ".$composer['description']."\n";
                $this->info("The description of your project is: ".$composer['description']."\n");
            } else {
                echo "The description of your project is not defined\n";
                $this->warning("The description of your project is not defined\n");
            }
            if (isset($composer['require'])) {
                if (isset($composer['require']['monolog/monolog']) && isset($composer['require']['php'])) {
                    echo "The monolog/monolog and php dependencies are defined\n";
                    $this->info("The monolog/monolog and php dependencies are defined\n");
                } else {
                    echo "The monolog/monolog and php dependencies are not defined\n";
                    $this->error("The monolog/monolog and php dependencies are not defined\n");
                }
            } else {
                echo "The dependencies are not defined\n";
                $this->error("The dependencies are not defined\n");
            }
        } else {
            echo "The path you entered is not valid\n";
            $this->error("The path you entered is not valid\n");
        }
    }
}

$log = new Log();
$log->checkComposer();

<?php
echo "\n?>\n";
?>