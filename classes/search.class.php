<?php

  class Search {
    protected $Conn;

    public function __construct($Conn){
      $this->Conn = $Conn;
    }

    public function searchHousesForSale($user_data){
      $query = "SELECT * FROM House_For_Sale WHERE addressline1 LIKE :query_string";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
        "query_string" => "%".$user_data."%"
      ]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchHousesForRent($user_data){
      $query = "SELECT * FROM House_For_Rent WHERE addressline1 LIKE :query_string";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
        "query_string" => "%".$user_data."%"
      ]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }
