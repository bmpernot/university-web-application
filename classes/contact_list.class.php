<?php
  class Contact_List {
    protected $Conn;

    public function __construct($Conn){
      $this->Conn = $Conn;
    }

    public function addToRentContactList($data){
      $query = "INSERT INTO Rent_Contact_List (
        customerID, houseforrentID, contacted
      ) VALUES (
        :customerID, :houseforrentID, false
      )";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute(array(
        "customerID" => $_SESSION['user_data']['customerID'],
        "houseforrentID" => $data['houseforrentID']
      ));
      return true;
    }

    public function addToSaleContactList($data){
      $query = "INSERT INTO Sale_Contact_List (
        customerID, houseforsaleID, contacted
      ) VALUES (
        :customerID, :houseforsaleID, false
      )";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute(array(
        "customerID" => $_SESSION['user_data']['customerID'],
        "houseforsaleID" => $data['houseforsaleID']
      ));
      return true;
    }

    public function getAllSaleListDetails(){
      $query = "SELECT Sale_Contact_List.*, Customer.firstname, Customer.lastname,
      Customer.email, Customer.mobile, House_For_Sale.addressline1,
      House_For_Sale.postcode, House_For_Sale.sellerID
      FROM Sale_Contact_List LEFT JOIN Customer
      ON Sale_Contact_List.customerID = Customer.customerID LEFT JOIN
      House_For_Sale ON Sale_Contact_List.houseforsaleID = House_For_Sale.houseforsaleID
      WHERE contacted = false";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute(array());
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRentListDetails(){
      $query = "SELECT Rent_Contact_List.*, Customer.firstname, Customer.lastname,
      Customer.email, Customer.mobile, House_For_Rent.addressline1,
      House_For_Rent.postcode, House_For_Rent.landlordID FROM Rent_Contact_List LEFT JOIN Customer
      ON Rent_Contact_List.customerID = Customer.customerID LEFT JOIN
      House_For_Rent ON Rent_Contact_List.houseforrentID = House_For_Rent.houseforrentID
      WHERE contacted = false";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute(array());
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function completeSaleContact($user_data){
      $query = "UPDATE Sale_Contact_List SET contacted = true
      WHERE salecontactlistID = :salecontactlistID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute(array(
        "salecontactlistID" => $user_data['saleid']
      ));
      return true;
    }
    public function completeRentContact($user_data){
      $query = "UPDATE Rent_Contact_List SET contacted = true
      WHERE rentcontactlistID = :rentcontactlistID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute(array(
        "rentcontactlistID" => $user_data['rentid']
      ));
      return true;
    }
  }
