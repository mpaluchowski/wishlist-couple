<?php
spl_autoload_extensions('.php');
spl_autoload_register();

$controller = new \lib\Controller();
$controller->processAction();
