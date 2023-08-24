<?php
  class Appointment {
    protected $Conn;

    public function __construct($Conn){
      $this->Conn = $Conn;
    }

    public function getAllCustomerAppointments(){
      $query = "SELECT * FROM Appointments
      WHERE customerID = :customerID
      AND completed = false";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([
      "customerID" => $_SESSION['user_data']['customerID']
      ]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function submitAppointment($user_data){
      $query = "INSERT INTO Appointments (
        customerID, rentorsale, addressline1, addressline2, addressline3, towncity,
        county, postcode, propertytype, bedrooms, bathrooms, gardensize, garage,
        addtionalinformation, completed
      ) VALUES (
        :customerID, :rentorsale, :addressline1, :addressline2, :addressline3, :towncity,
        :county, :postcode, :propertytype, :bedrooms, :bathrooms, :gardensize, :garage,
        :addtionalinformation, false
      )";
      $stmt = $this->Conn->prepare($query);
      return $stmt->execute(array(
        "customerID" => $_SESSION['user_data']['customerID'],
        "rentorsale" => $user_data['rentorsale'],
        "addressline1" => $user_data['addressline1'],
        "addressline2" => $user_data['addressline2'],
        "addressline3" => $user_data['addressline3'],
        "towncity" => $user_data['towncity'],
        "county" => $user_data['county'],
        "postcode" => $user_data['postcode'],
        "propertytype" => $user_data['property_type'],
        "bedrooms" => $user_data['bedrooms'],
        "bathrooms" => $user_data['bathrooms'],
        "gardensize" => $user_data['garden'],
        "garage" => $user_data['garage'],
        "addtionalinformation" => $user_data['description']
      ));
    }

    public function removeAppointment($user_data){
      $query = "DELETE FROM Appointments
      WHERE appointmentID = :appointmentID";
      $stmt = $this->Conn->prepare($query);
      return $stmt->execute(array(
        'appointmentID' => $user_data['select_appointment']
      ));
    }

    public function viewAllAppointments(){
      $query = "SELECT * FROM Appointments LEFT JOIN Customer
      ON Appointments.customerID = Customer.customerID
      WHERE completed = false";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute([]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function completeAppointment($user_data){
      $query = "UPDATE Appointments SET completed = true
      WHERE appointmentID = :appointmentID";
      $stmt = $this->Conn->prepare($query);
      $stmt->execute(array(
        "appointmentID" => $user_data['appointmentid']
      ));
      return true;
    }
  }
