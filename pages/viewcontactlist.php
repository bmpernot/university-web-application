<?php
$Contact = new Contact_List($Conn);
$rent_data = $Contact->getAllRentListDetails();
$sale_data = $Contact->getAllSaleListDetails();
?>

<div class="container">
  <h1 class="mb-4 pb-2">Contact Lists</h1>
  <?php
  if($_POST){
    if($_POST['completedsale']){
      $attempt = $Contact->completeSaleContact($_POST);

      if($attempt) {
        ?>
            <div class="alert alert-success" role="alert">
                Customer has been contacted about the house.
            </div>
        <?php
      }else{
        ?>
        <div class="alert alert-danger" role="alert">
          An error occurred, please try again later.
        </div>
        <?php
      }
    }
    elseif($_POST['completedrent']){
      $attempt = $Contact->completeRentContact($_POST);

      if($attempt) {
        ?>
            <div class="alert alert-success" role="alert">
                Customer has been contacted about the house.
            </div>
        <?php
      }else{
        ?>
        <div class="alert alert-danger" role="alert">
          An error occurred, please try again later.
        </div>
        <?php
      }
    }
  }
  ?>
  <h2>Sale Contact List</h2>
  <table class="table sale-contact-list-table">
    <thead>
      <tr>
        <th scope="col"><h5><strong>ID</strong></h5></th>
        <th scope="col"><h5><strong>Customer ID</strong></h5></th>
        <th scope="col"><h5><strong>First Name</strong></h5></th>
        <th scope="col"><h5><strong>Last Name</strong></h5></th>
        <th scope="col"><h5><strong>Email</strong></h5></th>
        <th scope="col"><h5><strong>Mobile</strong></h5></th>
        <th scope="col"><h5><strong>House ID</strong></h5></th>
        <th scope="col"><h5><strong>Address Line 1</strong></h5></th>
        <th scope="col"><h5><strong>Postcode</strong></h5></th>
        <th scope="col"><h5><strong>Seller ID</strong></h5></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($sale_data as $s_data) { ?>
        <tr>
          <th scope="row"><h6><?php echo $s_data['salecontactlistID']?></h6></th>
          <td><h6><?php echo $s_data['customerID']?></h6></td>
          <td><h6><?php echo $s_data['firstname']?></h6></td>
          <td><h6><?php echo $s_data['lastname']?></h6></td>
          <td><h6><?php echo $s_data['email']?></h6></td>
          <td><h6><?php echo $s_data['mobile']?></h6></td>
          <td><h6><?php echo $s_data['houseforsaleID']?></h6></td>
          <td><h6><?php echo $s_data['addressline1']?></h6></td>
          <td><h6><?php echo $s_data['postcode']?></h6></td>
          <td><h6><?php echo $s_data['sellerID']?></h6></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="row">
    <div class="col-md-12">
      <form id="sale-completed-form" method="post" action="">
        <div class="form-group">
          <label for="saleid">Sale Contact List ID</label>
          <select class="form-control" id="saleid" name="saleid">
            <option value="none" selected disabled hidden>Select an Option</option>
            <?php foreach ($sale_data as $s_data) { ?>
                <option value="<?php echo $s_data['salecontactlistID']?>">
                  Sale Contact List ID: <?php echo $s_data['salecontactlistID']?>
                </option>
              <?php } ?>
          </select>
        </div>
        <button type="submit" name="completedsale" value="1" class="btn btn-easymove">Completed</button>
      </form>
    </div>
  </div>

  <br>

  <h2>Rent Contact List</h2>
  <table class="table rent-contact-list-table">
    <thead>
      <tr>
        <th scope="col"><h5><strong>ID</strong></h5></th>
        <th scope="col"><h5><strong>Customer ID</strong></h5></th>
        <th scope="col"><h5><strong>First Name</strong></h5></th>
        <th scope="col"><h5><strong>Last Name</strong></h5></th>
        <th scope="col"><h5><strong>Email</strong></h5></th>
        <th scope="col"><h5><strong>Mobile</strong></h5></th>
        <th scope="col"><h5><strong>House ID</strong></h5></th>
        <th scope="col"><h5><strong>Address Line 1</strong></h5></th>
        <th scope="col"><h5><strong>Postcode</strong></h5></th>
        <th scope="col"><h5><strong>Landlord/Landlady ID</strong></h5></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($rent_data as $r_data) { ?>
        <tr>
          <th scope="row"><h6><?php echo $r_data['rentcontactlistID']?></h6></th>
          <td><h6><?php echo $r_data['customerID']?></h6></td>
          <td><h6><?php echo $r_data['firstname']?></h6></td>
          <td><h6><?php echo $r_data['lastname']?></h6></td>
          <td><h6><?php echo $r_data['email']?></h6></td>
          <td><h6><?php echo $r_data['mobile']?></h6></td>
          <td><h6><?php echo $r_data['houseforrentID']?></h6></td>
          <td><h6><?php echo $r_data['addressline1']?></h6></td>
          <td><h6><?php echo $r_data['postcode']?></h6></td>
          <td><h6><?php echo $r_data['landlordID']?></h6></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <div class="row">
    <div class="col-md-12">
      <form id="rent-completed-form" method="post" action="">
        <div class="form-group">
          <label for="rentid">Rent Contact List ID</label>
          <select class="form-control" id="rentid" name="rentid">
            <option value="none" selected disabled hidden>Select an Option</option>
            <?php foreach ($rent_data as $r_data) { ?>
              <option value="<?php echo $r_data['rentcontactlistID']?>">
                Rent Contact List ID: <?php echo $r_data['rentcontactlistID']?>
              </option>
            <?php } ?>
          </select>
        </div>
        <button type="submit" name="completedrent" value="1" class="btn btn-easymove">Completed</button>
      </form>
    </div>
  </div>
</div>
