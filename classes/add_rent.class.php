<?php
  class Add_Rent {
    protected $Conn;

    public function __construct($Conn){
      $this->Conn = $Conn;
    }

     public function createHouse($user_data){
       $query = "INSERT INTO House_For_Rent (
         landlordID, addressline1, addressline2, addressline3, towncity,
         county, postcode, lat, lng, avertisedprice, bedrooms, bathrooms,
         gardensize, garage, propertytype, propertydescription, dateadded
       ) VALUES (
         :landlordID, :addressline1, :addressline2, :addressline3, :towncity,
         :county, :postcode,:lat, :lng, :avertisedprice, :bedrooms, :bathrooms,
         :gardensize, :garage, :propertytype, :propertydescription, CURDATE()
       )";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "landlordID" => $user_data['landlordID'],
         "addressline1" => $user_data['addressline1'],
         "addressline2" => $user_data['addressline2'],
         "addressline3" => $user_data['addressline3'],
         "towncity" => $user_data['towncity'],
         "county" => $user_data['county'],
         "postcode" => $user_data['postcode'],
         "lat" => $user_data['lat'],
         "lng" => $user_data['lng'],
         "avertisedprice" => $user_data['avertisedprice'],
         "bedrooms" => $user_data['bedrooms'],
         "bathrooms" => $user_data['bathrooms'],
         "gardensize" => $user_data['garden'],
         "garage" => $user_data['garage'],
         "propertytype" => $user_data['property_type'],
         "propertydescription" => $user_data['propertydescription']
       ));
       return true;
     }

     public function addHouseThumbnail($file_name, $house_for_rent_id) {
       $query = "UPDATE House_For_Rent SET housethumbnail = :housethumbnail
       WHERE houseforrentID = :houseforrentID";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "housethumbnail" => $file_name,
         "houseforrentID" => $house_for_rent_id['houseforrentID']
       ));
       return true;
     }

     public function addHouseLayout($file_name, $house_for_rent_id) {
       $query = "UPDATE House_For_Rent SET layout = :layout
       WHERE houseforrentID = :houseforrentID";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "layout" => $file_name,
         "houseforrentID" => $house_for_rent_id['houseforrentID']
       ));
       return true;
     }

     public function addHouseImage($file_name, $house_for_rent_id) {
       $query = "INSERT INTO Rent_Images (houseID, image) VALUES (:houseID, :image)";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "houseID" => $house_for_rent_id['houseforrentID'],
         "image" => $file_name
       ));
       return true;
     }

     public function getHouseID($house_infomation){
       $query = "SELECT houseforrentID FROM House_For_Rent WHERE
        landlordID = :landlordID AND
        addressline1 = :addressline1 AND
        postcode = :postcode AND
        lat = :lat AND
        lng = :lng AND
        avertisedprice = :avertisedprice AND
        bedrooms = :bedrooms AND
        bathrooms = :bathrooms AND
        gardensize = :gardensize AND
        garage = :garage AND
        propertytype = :propertytype AND
        propertydescription = :propertydescription";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "landlordID" => $house_infomation['landlordID'],
         "addressline1" => $house_infomation['addressline1'],
         "postcode" => $house_infomation['postcode'],
         "lat" => $house_infomation['lat'],
         "lng" => $house_infomation['lng'],
         "avertisedprice" => $house_infomation['price'],
         "bedrooms" => $house_infomation['bedrooms'],
         "bathrooms" => $house_infomation['bathrooms'],
         "gardensize" => $house_infomation['garden'],
         "garage" => $house_infomation['garage'],
         "propertytype" => $house_infomation['property_type'],
         "propertydescription" => $house_infomation['propertydescription']
       ));
       return $stmt->fetch(PDO::FETCH_ASSOC);
     }
}
