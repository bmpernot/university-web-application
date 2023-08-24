<?php
  class Staff {
    protected $Conn;

    public function __construct($Conn){
      $this->Conn = $Conn;
    }

     public function createStaff($user_data){
       $sec_password = password_hash($user_data['password'], PASSWORD_DEFAULT);

       $query = "INSERT INTO Staff (
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

     public function loginStaff($user_data) {
       $query = "SELECT * FROM Staff WHERE email = :email AND staffID = :staffID";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         'email' => strtolower($user_data['email']),
         'staffID' => $user_data['id']
       ));
       $attempt = $stmt->fetch();

       if($attempt && password_verify($user_data['password'], $attempt['password'])) {
         return $attempt;
       }
       else{
         return false;
      }
     }

     public function updateStaffProfile($file_name){
       $query = "UPDATE Staff SET staffimage = :staffimage WHERE staffID = :staffID";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "staffimage" => $file_name,
         "staffID" => $_SESSION['user_data']['staffID']
       ));
       return true;
     }

     public function getStaff(){
       $query = "SELECT * FROM Staff WHERE staffID = :staffID";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "staffID" => $_SESSION['user_data']['staffID']
       ));
       return $stmt->fetch();
     }
  }
