<?php
$basePath = realpath(__DIR__);
chdir($basePath);
echo shell_exec('/opt/plesk/php/8.1/bin/php artisan schedule:run');
