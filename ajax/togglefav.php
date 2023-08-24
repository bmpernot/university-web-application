<?php

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'On');

session_start();

require_once(__DIR__.'/../includes/autoloader.php');
require_once(__DIR__.'/../includes/database.php');


if($_SESSION['user_data']) {
  if($_POST['house_rent_id']){
    $Favourite = new Favourite($Conn);
    $toggle = $Favourite->toggleHouseForRentFavourite($_POST['house_rent_id']);
    if($toggle){
      echo json_encode(array(
        "success" => true,
        "reason" => "House was added to favourites"
      ));
    }else {
      echo json_encode(array(
        "success" => true,
        "reason" => "House was removed from favourites"
      ));
    }
  }
  elseif($_POST['house_sale_id']){
    $Favourite = new Favourite($Conn);
    $toggle = $Favourite->toggleHouseForSaleFavourite($_POST['house_sale_id']);
    if($toggle){
      echo json_encode(array(
        "success" => true,
        "reason" => "House was added to favourites"
      ));
    }else {
      echo json_encode(array(
        "success" => true,
        "reason" => "House was removed from favourites"
      ));
    }
  }
  else {
    echo json_encode(array(
      "success" => false,
      "reason" => "House ID not provided"
    ));
  }
}else {
  echo json_encode(array(
    "success" => false,
    "reason" => "User not logged in"
  ));
}
