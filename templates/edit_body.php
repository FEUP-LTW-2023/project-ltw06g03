<?php
require_once('../utils/session.php');

//set Session

function drawEditBody(){
   $session = new Session();
   ?>

   <div class="edit-page" >
      <form action="../actions/update_user.php" method="post" enctype="multipart/form-data">
         <a href="../pages/home.php"><i class="fa fa-home"></i> Go to Home</a>
         <label> <img src="<?=$session->getUserImg()?>"><input type="file" accept="image/*" name="img"></label>
         <label ><h5>Name:</h5> <input type="text" name="name" value="<?= $session->getUsername()?>"></label>
         <label  ><h5>Email:</h5><input type="email" name="email" value="<?= $session->getEmail() ?> "> </label>
         <label  ><h5>New Password:</h5><input type="password" name="pass" placeholder="Change to update password"> </label>
         <label  ><h5>Confirm Password</h5><input type="password" name="pass" placeholder="Confirm your new password"> </label>
         <p class="errorMessage"></p>
         <button type="submit" >Save</button>

      </form>
   </div>

<?php }?>
