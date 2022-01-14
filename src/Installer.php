<?php

use Composer\Script\Event;

class Installer
{
    public function runSQL($host, $dbname, $username, $password)
    {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->exec(file_get_contents(__DIR__ . "/puxt.sql"));
    }

    public static function postPackageInstall(Event $event)
    {
        $installer = new Installer;
        echo "Database setup...\n";
        $config = [];
        $config["context"]["name"] = "_vx";

        $config["modules"] = ["mathsgod/puxt-vx"];

        $config["database"]["hostname"] = $installer->input("Please input the hostname: ");
        $config["database"]["username"] = $installer->input("Please input the username: ");
        $config["database"]["password"] = $installer->input("Please input the password: ");
        $config["database"]["database"] = $installer->input("Please input the database: ");


        $config["VX"]["jwt"]["secret"] =  $installer->generateRandomString();
        $config["VX"]["language"]["en"] = "English";
        $config["VX"]["language"]["zh-hk"] = "中文";


        $var = var_export($config, true);
        $var = str_replace("array (", "[", $var);
        $var = str_replace(")", "]", $var);
        file_put_contents(dirname(__DIR__) . "/cms/puxt.config.php", "<?php\n\nreturn " . $var . ";\n");



        $api_config = [];
        $api_config["database"]["hostname"] = $config["database"]["hostname"];
        $api_config["database"]["username"] = $config["database"]["username"];
        $api_config["database"]["password"] = $config["database"]["password"];
        $api_config["database"]["database"] = $config["database"]["database"];
        $var = var_export($api_config, true);
        $var = str_replace("array (", "[", $var);
        $var = str_replace(")", "]", $var);
        file_put_contents(dirname(__DIR__) . "/api/puxt.config.php", "<?php\n\nreturn " . $var . ";\n");


        echo "Install database\n";
        $installer->runSQL($config["database"]["hostname"], $config["database"]["database"], $config["database"]["username"], $config["database"]["password"]);
    }

    function input(string $prompt = null): string
    {
        echo $prompt;
        $handle = fopen("php://stdin", "r");
        $output = fgets($handle);
        return trim($output);
    }

    function generateRandomString($length = 128)
    {
        $string = '';
        $string .= '0123456789';
        $string .= 'abcdefghijklmnopqrstuvwxyz';
        $string .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($x = $string, ceil($length / strlen($x)))), 1, $length);
    }
}
