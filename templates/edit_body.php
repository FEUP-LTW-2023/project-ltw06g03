<?php
require_once('../utils/session.php');

//set Session

function drawEditBody(){
   $session = new Session();
   ?>

   <div class="edit-page" >
      <form>
         <a href="../pages/home.php"><i class="fa fa-home"></i> Go to Home</a>
         <label> <img src="<?=$session->getUserImg()?>"><input type="file" accept="image/*"></label>
         <label ><h5>Name:</h5> <input type="text" name="name" value="<?= $session->getUsername()?>"></label>
         <label  ><h5>Email:</h5><input type="email" name="email" value="<?= $session->getEmail() ?> "> </label>
         <label  ><h5>New Password:</h5><input type="password" name="pass" value="<?= $session->get() ?> "> </label>
         <label  ><h5>Confirm Password</h5><input type="password" name="confPass" value="<?= $session->getEmail() ?> "> </label>
         <button type="submit" >Save</button>

      </form>
   </div>

<?php }?>
