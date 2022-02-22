<?php

use Composer\Script\Event;

class Installer
{
    public function runSQL($host, $dbname, $username, $password)
    {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->exec(file_get_contents(__DIR__ . "/puxt.sql"));


        //

        $pdo->exec(
            <<<SQL
CREATE TABLE `Document` (
    `document_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) DEFAULT NULL,
    `created_time` datetime DEFAULT NULL,
    `created_by` int(11) DEFAULT NULL,
    PRIMARY KEY (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQL
        );


        $pdo->exec(
            <<<SQL
CREATE TABLE `Updates` (
    `updates_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `type` int(11) DEFAULT NULL,
    `sequence` int(11) NOT NULL DEFAULT '0',
    `status` int(11) NOT NULL DEFAULT '2',
    `title_en` text,
    `title_tc` text,
    `title_sc` text,
    `file_en` text,
    `file_tc` text,
    `file_sc` text,
    `file_hash_en` longtext,
    `file_hash_tc` longtext,
    `file_hash_sc` longtext,
    `link_en` text,
    `link_tc` text,
    `link_sc` text,
    `date` date DEFAULT NULL,
    `thumbnail` text,
    `created_time` datetime NOT NULL,
    `created_by` int(11) NOT NULL,
    `updated_time` datetime DEFAULT NULL,
    `updated_by` int(11) DEFAULT NULL,
    PRIMARY KEY (`updates_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL
        );
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

        mkdir(dirname(__DIR__). "/cache", 0777 );        
        mkdir(dirname(__DIR__). "/uploads", 0777 );
        $config["VX"]["file_manager"]["root"] = dirname(__DIR__). "/uploads";

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
        echo "done\n";
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
