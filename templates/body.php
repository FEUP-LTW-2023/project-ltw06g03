<?php
function drawHomeBody(){
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/faqs.php');
    $session = new Session();
    ?>

<section class="homePageHeader">
    <?php if(!$session->isLoggedIn()){?>
        <section class="loginRegister">
            <a  href="../pages/register.php">Register</a>
            <a href="../pages/login.php">Login</a>
        </section>
    <?php }?>
    <header>
        <h1>Feup Trouble Ticket's</h1>
        <h2>Create tickets for your problems</h2>

    </header>
    <div class="indicator">
        <a href="#about"><i class='fas fa-angle-down'></i></a>
        <a href="#about"><i class='fas fa-angle-down'></i></a>
        <a href="#about"><i class='fas fa-angle-down'></i></a>
    </div>

</section>
    <section class="about" id="about">
        <h1>Frequently Asked Questions</h1>
        <article>
            <div class="Text">
                <header><span>Some Text</span></header>

                <p>freestar
                    freestar
                    What is Lorem Ipsum?

                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Why do we use it?

                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                </p>
            </div>
            <img src="../docs/feup.png">

        </article>
        <article>
            <div class="Text">
                <header><span>Some Text</span></header>

                <p>freestar
                    freestar
                    What is Lorem Ipsum?

                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Why do we use it?

                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                </p>
            </div>
            <img src="../docs/feup.png">

        </article>
        <article>
            <div class="Text">
                <header><span>Some Text</span></header>

                <p>freestar
                    freestar
                    What is Lorem Ipsum?

                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Why do we use it?

                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                </p>
            </div>
            <img src="../docs/feup.png">

        </article>
    </section>



<?php

}


function drawLogin() {?>

<section class="loginRegisterForm" name="LoginForm" >
    <form class="loginForm"  >
        <a href="../pages/home.php"><i class="fa fa-home"></i> Go to Home</a>
        <h3>Login</h3>
        <label>
            <h4>Up</h4><input  type="number" placeholder="xxxxxxxxx" required name="up">
        </label>
        <label>
        <input type="password" placeholder="Password" required name="pass">
            <i class="fas fa-eye"></i>
        </label>
        <p class="errorMessage"></p>
        <a href="../pages/register.php">Don't have an account?</a>

        <button>Login</button>
    </form>
</section>
<?php } 

function drawRegister() {?>

<section class="loginRegisterForm" name="RegisterForm" >
    <form class="registerForm" method="post" action="../actions/register.php">
        <a href="../pages/home.php"><i class="fa fa-home"></i> Go to Home</a>
        <h3>Register</h3>
        <label >
            <h4>Up</h4><input  type="number" placeholder="xxxxxxxxx" required name="up">
        </label>
        <label>
            <input  type="text" placeholder="Name" required name="name">
        </label>
        <label>
            <input  type="email" placeholder="Alternative Email" name="email">
        </label>
        <label>
            <input type="password" placeholder="Password" required name="pass">
            <i class="fas fa-eye"></i>
        </label>
        <label>
        <input type="password" placeholder="Confirm Password" required name="pass">
            <i class="fas fa-eye"></i>
        </label>
        <p class="errorMessage"></p>
        <a href="../pages/login.php">Already have an account?</a>
        <button name="Register" type="submit">Register</button>
    </form>
</section>


<?php } 



function drawProfileBody($session) {

    require_once ("../database/user.class.php");
    require_once ("../database/connection.php");
    require_once ("../database/filters.php");

    if(isset($_GET['up']))$up=encode_int($_GET['up']);
    else $up=$session->getUp();


    $user= User::getUser(getDatabaseConnection(),$up);
    $user_up = $session->getUp();
    $username = $user->name;
    $userType = $user->role;
    $userEmail = $user->email;
    $userDepartments = $user->departments;
    $date = $session->getDateOfRegister();
    $userImg = $user->img;

    ?>
    <section class="user-page">

    <section class="user">
        <div class="user-icon-info">
            <?php 
            if ($userImg != null) {
                echo '<img src="' . $userImg . '" alt="user-img">' ;
            }
            else { ?>
                <i class="fas fa-user"></i>
            <?php } ?>

            <h2> <?=$username ?> </h2>
            <h3> up<?= $up ?> </h3>
            <h4> <?= $userType ?> </h4>
        </div>

        <div class="user-info">
            <h4> User Email: <?= $userEmail ?> </h4>
            <h4> This user joined at: <?= $date ?> </h4>
            <?php if(count($userDepartments)>0){ ?>
            <h4> Departments: </h4>
            <ul>
            <?php if ($userType != 'Student') {
                for ($i = 0; $i < count($userDepartments); $i++) { ?>
                    <li><h4> <?= $userDepartments[$i]?> </h4></li>
            <?php }
            } ?>
            </ul>
            <?php } ?>
        </div>
        <?php if($user_up===$up){ ?>
        <div class="links">
            <?php
                echo '<a href="../pages/tickets.php?up=' . $up . '"> User Tickets <i class="fas fa-ticket-alt"></i></a>';
            ?>
            <a href ="../actions/logout.php"> Sign Out <i class="fas fa-sign-out-alt"></i></a>
            <a href="../pages/edit.php?up=<?= $up ?>"> Edit Info <i class="fas fa-edit"></i></a>
        </div>
        <?php }?>
    </section>
    </section>
<?php }

function drawUsersBody($session){ 

    $db = getDatabaseConnection();
    
    $users = User::getUsers($db);

    ?>

    <section class="staff-page">
        <section class="users-body">
            <input id="searchuser" type="text" placeholder="Search for an user">

            <section class="table">
                <table>

                    <thead>

                        <th><h2> User </h2></th>
                        <th><h2> Up </h2></th>
                        <th><h2> Email </h2></th>
                        <th><h2> Departments </h2></th>
                        <th></th>

                    </thead>

                    <tbody id="table-box">
                        
                        <?php foreach($users as $user){ ?>

                            <tr id="user-<?= $user->up ?>">

                                <td>
                                    <h2><?= $user->name ?></h2>
                                    <h3 class="user-role"><?= $user->role ?></h3>
                                </td> 

                                <td> <h3><?= $user->up?> </h3></td>

                                <td> <h3><?= $user->email?>  </h3></td>

                                <td>
                                    <section class="departments">
                                    <?php 
                                        
                                        if (!count($user->departments)) { ?>
                                            <h4 class="no-department"> User is not assigned to any department </h4>
                                        <?php }
                                        else { ?>
                                        <div class="department-list-<?=$user->up?>">
                                        <?php    for ($i = 0; $i < count($user->departments); $i++) { ?>
                                                <h4 class="department"><?=$user->departments[$i]?></h4>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                        </section>
                                </td>

                                <td class="users-buttons-<?=$user->up?>">

                                    <button><a href="../pages/profile.php?up=<?=$user->up?>"><i class="fas fa-search"></i></a></button><!--
                                    <?php if ($user->role != "Student") {?> 
                                        --><button class="edit-departments" id="edit-departments-<?= $user->up ?>"><i class="fas fa-building"></i></button><!--<?php } ?>
                                    <?php if ($session->isAdmin()) {?>
                                        --><button class="edit-role" id="edit-role-<?= $user->up ?>"><i class="fas fa-user-tag"></i></button>
                                    <?php } 
                                        else { ?> --> <?php }
                                    ?>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>

            </table>
            </section>

        </se>
    <?php if($session->isAdmin()) {?>
    <div class="add-buttons">
        <button><a href="../pages/addFields.php"><i class="fas fa-plus"></i>  Add Department or Status </a></button>
    </div>
    <?php }?>

</section>

        

<?php } 

function drawEditBody(){
   $session = new Session();
   ?>

   <section class="edit-page" >
      <form action="" method="post" enctype="multipart/form-data">
         <a href="../pages/home.php"><i class="fa fa-home"></i> Go to Home</a>
         <label for="image_input"> <img src="<?=$session->getUserImg()?>"></label>
         <input type="file" accept="image/*" name="img" id="image_input">
         <label for="name_input"><h5>Name:</h5></label>
         <input type="text" name="name" value="<?= $session->getUsername()?>" id="name_input">
         <label  for="email_input"><h5>Email:</h5></label>
         <input type="email" name="email" value="<?= $session->getEmail() ?>" id="email_input">
         <label  for="pass_input"><h5>New Password:</h5></label>
         <input type="password" name="pass" placeholder="Change to update password" id="pass_input">
         <i class="fas fa-eye"></i>
         <label for="confirm_input" ><h5>Confirm Password</h5></label>
         <input type="password" name="pass" placeholder="Confirm your new password" id="confirm_input">
         <i class="fas fa-eye"></i>
         <p class="errorMessage"></p>
         <button type="submit" >Save</button>

      </form>
   </section>

<?php } 


function drawAddBody() {
    ?>
    <section class="add-page">

        <form action="../actions/add_department.php?name=" class="add-department">
            <label for="name">Department Name:</label>
            <input type="text" name="name" id="name">
            <p class="errorMessage"></p>
            <button type="submit"><i class="fas fa-plus"></i> Add Department </button>
        </form>


        <form action="../actions/add_status.php" class="add-status">
            <label for="status-name">Status Name:</label>
            <input type="text" name="name" id="status-name">
            <p class="errorMessage"></p>
            <button type="submit"><i class="fas fa-plus"></i> Add Status </button>
        </form>
    </section>

<?php } ?>
