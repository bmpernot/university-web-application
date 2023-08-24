<div class="container">
  <h1>Update Profile Photo</h1>
  <?php
    if(isset($_FILES['photo'])) {
      $allowed_mime = array('image/gif', 'image/jpeg', 'image/png');
      if(!in_array($_FILES['photo']['type'], $allowed_mime)) {
        echo '<div class="alert alert-danger">Only GIF, JPEG, JPG, and PNG are allowed.</div>';
      }
      elseif($_FILES['photo']['size'] >= 20480){
        echo '<div class="alert alert-danger">Only allow photo less than 20KB in size.</div>';
      }
      else{
        $random = substr(str_shuffle(MD5(microtime())), 0, 10);
        $new_filename = $random.$_FILES['photo']['name'];
        if(move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__.'/../user-images/'.$new_filename)){
          // file moved
          if($_SESSION['is_staff']) {
            $User = new Staff($Conn);
            $attempt = $User->updateStaffProfile($new_filename);
          }else{
            $User = new Customer($Conn);
            $attempt = $User->updateCustomerProfile($new_filename);
          }
          if($attempt){
            echo '<div class="alert alert-success">Profile photo uploaded</div>';
          }else{
              echo '<div class="alert alert-danger">An error occured. Please try again later.</div>';
          }
        }else {
          echo '<div class="alert alert-danger">Only GIF, JPEG, JPG, and PNG are allowed.</div>';
        }
      }
    }
   ?>
  <form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
      <label for="photo">Photo</label>
      <input type="file" class="form-control-file" name="photo">
    </div>
    <button type="submit" class="btn btn-easymove">Update Profile Photo</button>
  </form>
</div>
