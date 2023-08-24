<?php

class Review {
  protected $Conn;

  public function __construct($Conn){
      $this->Conn = $Conn;
  }

  public function createReview($review_data) {
    $query = "INSERT INTO Rent_Reviews (houseID, customerID, review) VALUES (:houseID, :customerID, :review)";
    $stmt = $this->Conn->prepare($query);
    return $stmt->execute([
      "houseID" => $review_data['recipe_id'],
      "customerID" => $_SESSION['user_data']['customerID'],
      "review" => $review_data['review_rating']
    ]);
  }

  public function calculateRating($houseID) {
    $query = "SELECT AVG(review) AS avg_rating FROM Rent_Reviews WHERE houseID = :houseID";
    $stmt = $this->Conn->prepare($query);
    $stmt->execute([
      "houseID" => $houseID
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
