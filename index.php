<?php
define("ROOT", realpath(__dir__));
error_reporting(E_ALL);
ini_set("display_errors", 'on');
session_start();
require_once(ROOT . "/app/kernel/Kernel.php");
Kernel::run();