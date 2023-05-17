<?php
require_once('../utils/session.php');

//set Session

function drawEditBody(){
   $session = new Session();
   ?>

   <div class="edit-page" >
      <form action="../actions/update_user.php" method="post" enctype="multipart/form-data">
         <a href="../pages/home.php"><i class="fa fa-home"></i> Go to Home</a>
         <label for="image_input"> <img src="<?=$session->getUserImg()?>"></label>
         <input type="file" accept="image/*" name="img" id="image_input">
         <label for="name_input"><h5>Name:</h5></label>
         <input type="text" name="name" value="<?= $session->getUsername()?> " id="name_input">
         <label  for="email_input"><h5>Email:</h5></label>
         <input type="email" name="email" value="<?= $session->getEmail() ?> " id="email_input">
         <label  for="pass_input"><h5>New Password:</h5></label>
         <input type="password" name="pass" placeholder="Change to update password" id="pass_input">
         <i class="fas fa-eye"></i>
         <label for="confirm_input" ><h5>Confirm Password</h5></label>
         <input type="password" name="pass" placeholder="Confirm your new password" id="confirm_input">
         <i class="fas fa-eye"></i>
         <p class="errorMessage"></p>
         <button type="submit" >Save</button>

      </form>
   </div>

<?php }?>
