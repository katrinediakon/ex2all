<?php

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/function.php"))
require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/function.php");

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/email.php"))
require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/email.php");

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/menu.php"))
require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/menu.php");

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/error.php"))
require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/error.php");

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/meta.php"))
require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/meta.php");

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/agent.php"))
require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/agent.php");

 ?>
