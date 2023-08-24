<?php

  class House {
    protected $Conn;

    public function __construct($Conn) {
      $this->Conn = $Conn;
    }

    public function getHouseForSale($user_data) {
      $query = "SELECT * FROM House_For_Sale WHERE houseforsaleID = :houseforsaleID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
        "houseforsaleID" => $user_data
      ]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getHouseForSaleImages($user_data) {
      $query = "SELECT * FROM Sale_Images WHERE houseID = :houseID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
        "houseID" => $user_data
      ]);
      return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getHouseForRent($user_data) {
      $query = "SELECT * FROM House_For_Rent WHERE houseforrentID = :houseforrentID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
        "houseforrentID" => $user_data
      ]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getHouseForRentImages($user_data) {
      $query = "SELECT * FROM Rent_Images WHERE houseID = :houseID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
        "houseID" => $user_data
      ]);
      return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getHousesForSaleWithFiler($filter_data) {
    $query = "SELECT * FROM House_For_Sale";
    if($filter_data){
      if($filter_data['max_price'] != "" ||
      $filter_data['bedrooms'] != "" ||
      $filter_data['bathrooms'] != "" ||
      $filter_data['max_garden'] != "" ||
      $filter_data['garage'] != "none" ||
      $filter_data['property_type'] != "none" ||
      $filter_data['new_or_resale'] != "none" ||
      $filter_data['modernisation'] != "none" ||
      $filter_data['max_date'] != ""
      ) {
        $query .= " WHERE";
        $data = [];
      }
      if($filter_data['max_price'] != ""){
        $query .= " resaleprice BETWEEN :min_price AND :max_price AND";
        $data['min_price'] = $filter_data['min_price'];
        $data['max_price'] = $filter_data['max_price'];
      }
      if($filter_data['bedrooms'] != ""){
        $query .= " bedrooms = :bedrooms AND";
        $data['bedrooms'] = $filter_data['bedrooms'];
      }
      if($filter_data['bathrooms'] != ""){
        $query .= " bathrooms = :bathrooms AND";
        $data['bathrooms'] = $filter_data['bathrooms'];
      }
      if($filter_data['max_garden'] != ""){
        $query .= " gardensize BETWEEN :min_garden AND :max_garden AND";
        $data['min_garden'] = $filter_data['min_garden'];
        $data['max_garden'] = $filter_data['max_garden'];
      }
      if($filter_data['garage'] != "none"){
        $query .= " garage = :garage AND";
        $data['garage'] = $filter_data['garage'];
      }
      if($filter_data['property_type'] != "none"){
        $query .= " propertytype = :property_type AND";
        $data['property_type'] = $filter_data['property_type'];
      }
      if($filter_data['new_or_resale'] != "none"){
        $query .= " new = :new_or_resale AND";
        $data['new_or_resale'] = $filter_data['new_or_resale'];
      }
      if($filter_data['modernisation'] != "none"){
        $query .= " needmodernisation = :modernisation AND";
        $data['modernisation'] = $filter_data['modernisation'];
      }
      if($filter_data['max_date'] != ""){
        $query .= " dateadded BETWEEN :min_date AND :max_date AND";
        $data['min_date'] = $filter_data['min_date'];
        $data['max_date'] = $filter_data['max_date'];
      }
      $pattern = "/AND$/";
      if(preg_match($pattern, $query) == 1){
        $query = substr($query, 0, -4);
      }
    }
    $stmt = $this->Conn->prepare($query);
    $stmt->execute($data);
    return $stmt->fetchALL(PDO::FETCH_ASSOC);
  }

  public function getHousesForRentWithFiler($filter_data) {
  $query = "SELECT * FROM House_For_Rent";
  if($filter_data){
    if($filter_data['max_price'] != "" ||
    $filter_data['bedrooms'] != "" ||
    $filter_data['bathrooms'] != "" ||
    $filter_data['max_garden'] != "" ||
    $filter_data['garage'] != "none" ||
    $filter_data['property_type'] != "none" ||
    $filter_data['max_date'] != ""
    ) {
      $query .= " WHERE";
      $data = [];
    }
    if($filter_data['max_price'] != ""){
      $query .= " avertisedprice BETWEEN :min_price AND :max_price AND";
      $data['min_price'] = $filter_data['min_price'];
      $data['max_price'] = $filter_data['max_price'];
    }
    if($filter_data['bedrooms'] != ""){
      $query .= " bedrooms = :bedrooms AND";
      $data['bedrooms'] = $filter_data['bedrooms'];
    }
    if($filter_data['bathrooms'] != ""){
      $query .= " bathrooms = :bathrooms AND";
      $data['bathrooms'] = $filter_data['bathrooms'];
    }
    if($filter_data['max_garden'] != ""){
      $query .= " gardensize BETWEEN :min_garden AND :max_garden AND";
      $data['min_garden'] = $filter_data['min_garden'];
      $data['max_garden'] = $filter_data['max_garden'];
    }
    if($filter_data['garage'] != "none"){
      $query .= " garage = :garage AND";
      $data['garage'] = $filter_data['garage'];
    }
    if($filter_data['property_type'] != "none"){
      $query .= " propertytype = :property_type AND";
      $data['property_type'] = $filter_data['property_type'];
    }
    if($filter_data['max_date'] != ""){
      $query .= " dateadded BETWEEN :min_date AND :max_date AND";
      $data['min_date'] = $filter_data['min_date'];
      $data['max_date'] = $filter_data['max_date'];
    }
    $pattern = "/AND$/";
    if(preg_match($pattern, $query) == 1){
      $query = substr($query, 0, -4);
    }
  }
  $stmt = $this->Conn->prepare($query);
  $stmt->execute($data);
  return $stmt->fetchALL(PDO::FETCH_ASSOC);
  }

  public function getHousesForSale(){
    $query = "SELECT * FROM House_For_Sale";
    $stmt = $this->Conn->prepare($query);
    $stmt->execute($data);
    return $stmt->fetchALL(PDO::FETCH_ASSOC);
  }

  public function getHousesForRent(){
    $query = "SELECT * FROM House_For_Rent";
    $stmt = $this->Conn->prepare($query);
    $stmt->execute($data);
    return $stmt->fetchALL(PDO::FETCH_ASSOC);
  }
}
