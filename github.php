<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
set_time_limit(0);
 
    $output = shell_exec("/var/www/BusinessWebSys/git-puller.sh");
 
?>
