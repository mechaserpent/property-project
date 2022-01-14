<?php

use Composer\Script\Event;

class Installer
{
    public static function postPackageInstall(Event $event)
    {
        echo "Database setup...\n";
    }
}
