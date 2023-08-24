<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'On');

session_start();

require_once(__DIR__.'/includes/autoloader.php');
require_once(__DIR__.'/includes/database.php');

if($_SESSION['is_staff']) {
  $Staff = new Staff($Conn);
  $user_data = $Staff->getStaff();
  $_SESSION['user_data'] = $user_data;
}elseif($_SESSION['user_data']){
  $Customer = new Customer($Conn);
  $user_data = $Customer->getCustomer();
  $_SESSION['user_data'] = $user_data;
}

$page = $_GET['p'];
if(!$page){
    $page = "home";
}

require_once(__DIR__.'/includes/header.php');
require_once(__DIR__.'/pages/'.$page.'.php');
require_once(__DIR__.'/includes/footer.php');
