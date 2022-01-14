<?php

use Composer\Script\Event;

class Installer
{
    public static function postPackageInstall(Event $event)
    {
        echo "Database setup...\n";
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
