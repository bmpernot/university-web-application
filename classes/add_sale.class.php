<?php
  class Add_Sale {
    protected $Conn;

    public function __construct($Conn){
      $this->Conn = $Conn;
    }

     public function createHouse($user_data){
       $query = "INSERT INTO House_For_Sale (
         sellerID, addressline1, addressline2, addressline3, towncity, county, postcode,
         lat, lng, resaleprice, bedrooms, bathrooms, gardensize, garage, new,
         needmodernisation, propertytype, propertydescription, dateadded, sold
       ) VALUES (
         :sellerID, :addressline1, :addressline2, :addressline3, :towncity, :county, :postcode,
         :lat, :lng, :resaleprice, :bedrooms, :bathrooms, :gardensize, :garage, :new,
         :needmodernisation, :propertytype, :propertydescription, CURDATE(), false
       )";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "sellerID" => $user_data['sellerID'],
         "addressline1" => $user_data['addressline1'],
         "addressline2" => $user_data['addressline2'],
         "addressline3" => $user_data['addressline3'],
         "towncity" => $user_data['towncity'],
         "county" => $user_data['county'],
         "postcode" => $user_data['postcode'],
         "lat" => $user_data['lat'],
         "lng" => $user_data['lng'],
         "resaleprice" => $user_data['price'],
         "bedrooms" => $user_data['bedrooms'],
         "bathrooms" => $user_data['bathrooms'],
         "gardensize" => $user_data['garden'],
         "garage" => $user_data['garage'],
         "new" => $user_data['new'],
         "needmodernisation" => $user_data['modernisation'],
         "propertytype" => $user_data['property_type'],
         "propertydescription" => $user_data['propertydescription']
       ));
       return true;
     }

     public function addHouseThumbnail($file_name, $house_for_sale_id) {
       $query = "UPDATE House_For_Sale SET housethumbnail = :housethumbnail
       WHERE houseforsaleID = :houseforsaleID";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "housethumbnail" => $file_name,
         "houseforsaleID" => $house_for_sale_id['houseforsaleID']
       ));
       return true;
     }

     public function addHouseLayout($file_name, $house_for_sale_id) {
       $query = "UPDATE House_For_Sale SET layout = :layout
       WHERE houseforsaleID = :houseforsaleID";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "layout" => $file_name,
         "houseforsaleID" => $house_for_sale_id['houseforsaleID']
       ));
       return true;
     }

     public function addHouseImage($file_name, $house_for_sale_id) {
       $query = "INSERT INTO Sale_Images (houseID, image) VALUES (:houseID, :image)";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "houseID" => $house_for_sale_id['houseforsaleID'],
         "image" => $file_name
       ));
       return true;
     }

     public function getHouseID($house_infomation){
       $query = "SELECT houseforsaleID FROM House_For_Sale WHERE
        sellerID = :sellerID AND
        addressline1 = :addressline1 AND
        postcode = :postcode AND
        lat = :lat AND
        lng = :lng AND
        resaleprice = :resaleprice AND
        bedrooms = :bedrooms AND
        bathrooms = :bathrooms AND
        gardensize = :gardensize AND
        garage = :garage AND
        new = :new AND
        needmodernisation = :needmodernisation AND
        propertytype = :propertytype AND
        propertydescription = :propertydescription";
       $stmt = $this->Conn->prepare($query);
       $stmt->execute(array(
         "sellerID" => $house_infomation['sellerID'],
         "addressline1" => $house_infomation['addressline1'],
         "postcode" => $house_infomation['postcode'],
         "lat" => $house_infomation['lat'],
         "lng" => $house_infomation['lng'],
         "resaleprice" => $house_infomation['price'],
         "bedrooms" => $house_infomation['bedrooms'],
         "bathrooms" => $house_infomation['bathrooms'],
         "gardensize" => $house_infomation['garden'],
         "garage" => $house_infomation['garage'],
         "new" => $house_infomation['new'],
         "needmodernisation" => $house_infomation['modernisation'],
         "propertytype" => $house_infomation['property_type'],
         "propertydescription" => $house_infomation['propertydescription']
       ));
       return $stmt->fetch(PDO::FETCH_ASSOC);
     }
}
