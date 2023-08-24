<?php
  class Customer {
    protected $Conn;

    public function __construct($Conn){
      $this->Conn = $Conn;
    }

     public function createCustomer($user_data){
       $sec_password = password_hash($user_data['password'], PASSWORD_DEFAULT);

       $query = "INSERT INTO Customer (
         email, password, firstname, lastname, addressline1, addressline2, addressline3, towncity,
         county, postcode, mobile
       ) VALUES (
         :email, :password, :firstname, :lastname, :addressline1, :addressline2, :addressline3, :towncity,
         :county, :postcode, :mobile
       )";

       $stmt = $this->Conn->prepare($query);

       return $stmt->execute(array(
         'email' => strtolower($user_data['email']),
         'password' => $sec_password,
         'firstname' => $user_data['first_name'],
         'lastname' => $user_data['last_name'],
         'addressline1' => $user_data['address_line_1'],
         'addressline2' => $user_data['address_line_2'],
         'addressline3' => $user_data['address_line_3'],
         'towncity' => $user_data['town_city'],
         'county' => $user_data['county'],
         'postcode' => $user_data['postcode'],
         'mobile' => $user_data['mobile']
       ));
     }

     public function loginCustomer($user_data) {
       $query = "SELECT * FROM Customer WHERE email = :email";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         'email' => strtolower($user_data['email'])
       ));
       $attempt = $stmt->fetch();

       if($attempt && password_verify($user_data['password'], $attempt['password'])) {
         return $attempt;
       }
       else{
         return false;
      }
     }

     public function updateCustomerProfile($file_name){
       $query = "UPDATE Customer SET customerimage = :customerimage WHERE customerID = :customerID";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "customerimage" => $file_name,
         "customerID" => $_SESSION['user_data']['customerID']
       ));
       return true;
     }

     public function getCustomer(){
       $query = "SELECT * FROM Customer WHERE customerID = :customerID";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "customerID" => $_SESSION['user_data']['customerID']
       ));
       return $stmt->fetch();
     }

     public function getAllCustomers(){
       $query = "SELECT * FROM Customer";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array());
       return $stmt->fetchAll();
     }
  }
