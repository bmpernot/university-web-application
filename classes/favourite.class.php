<?php

  class Favourite {
    protected $Conn;

    public function __construct($Conn) {
      $this->Conn = $Conn;
    }

    public function isHouseForSaleFavourite($house_id) {
      $query = "SELECT * FROM Customer_Sale_Fav WHERE customerID = :customerID AND houseID = :houseID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
        "customerID" => $_SESSION['user_data']['customerID'],
        "houseID" => $house_id
      ]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isHouseForRentFavourite($house_id) {
      $query = "SELECT * FROM Customer_Rent_Fav WHERE customerID = :customerID AND houseID = :houseID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
        "customerID" => $_SESSION['user_data']['customerID'],
        "houseID" => $house_id
      ]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function toggleHouseForSaleFavourite($house_id) {
      $is_house_favourite = $this->isHouseForSaleFavourite($house_id);

      if($is_house_favourite) {
        $query = "DELETE FROM Customer_Sale_Fav WHERE favsaleID = :favsaleID";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
          "favsaleID" => $is_house_favourite['favsaleID']
        ]);
        return false;
      }else{
        $query = "INSERT INTO Customer_Sale_Fav (customerID, houseID) VALUES (:customerID, :houseID)";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
          "customerID" => $_SESSION['user_data']['customerID'],
          "houseID" => $house_id
        ]);
        return true;
      }
    }

    public function toggleHouseForRentFavourite($house_id) {
      $is_house_favourite = $this->isHouseForRentFavourite($house_id);

      if($is_house_favourite) {
        $query = "DELETE FROM Customer_Rent_Fav WHERE favrentID = :favrentID";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
          "favrentID" => $is_house_favourite['favrentID']
        ]);
        return false;
      }else{
        $query = "INSERT INTO Customer_Rent_Fav (customerID, houseID) VALUES (:customerID, :houseID)";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
          "customerID" => $_SESSION['user_data']['customerID'],
          "houseID" => $house_id
        ]);
        return true;
      }
    }

    public function getAllHouseForSaleFavourites() {
      $query = "SELECT * FROM Customer_Sale_Fav LEFT JOIN House_For_Sale
      ON Customer_Sale_Fav.houseID = House_For_Sale.houseforsaleID
      WHERE Customer_Sale_Fav.customerID = :customerID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
        "customerID" => $_SESSION['user_data']['customerID'],
      ]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllHouseForRentFavourites() {
      $query = "SELECT * FROM Customer_Rent_Fav LEFT JOIN House_For_Rent
      ON Customer_Rent_Fav.houseID = House_For_Rent.houseforrentID
      WHERE Customer_Rent_Fav.customerID = :customerID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
        "customerID" => $_SESSION['user_data']['customerID'],
      ]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }
