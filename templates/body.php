<?php
function drawHomeBody(){
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
    ?>

<div class="homePageHeader">
    <?php if(!$session->isLoggedIn()){?>
        <div class="loginRegister">
            <a  href="../pages/register.php">Register</a>
            <a href="../pages/login.php">Login</a>
        </div>
    <?php }?>
    <header>
        <h1>Feup Trouble Ticket's</h1>
        <h2>Create tickets for your problems</h2>

    </header>
    <div class="indicator">
        <a href="#FAQ"><i class='fas fa-angle-down'></i></a>
        <a href="#FAQ"><i class='fas fa-angle-down'></i></a>
        <a href="#FAQ"><i class='fas fa-angle-down'></i></a>
    </div>

</div>
    <section class="FAQ" id="FAQ">
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


<?php }


function drawLogin() {?>

<div class="loginRegisterForm" name="LoginForm" >
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
</div>
<?php } 

function drawRegister() {?>

<div class="loginRegisterForm" name="RegisterForm" >
    <form class="registerForm" method="post" action="../database/register.php">
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
</div>


<?php } 



function drawProfileBody($session) {
    
    $up = $session->getUp();
    $username = $session->getUsername();
    $userType = $session->getUserType();
    $userEmail = $session->getEmail();
    $userDepartments = $session->getDepartments();
    $date = $session->getDateOfRegister();
    $userImg = $session->getUserImg();
    require_once('../templates/tickets.php');
    require_once ("../database/user.class.php");
    require_once ("../database/connection.php");
    $tickets= Ticket::getTickets(getDatabaseConnection(),$up);
    ?>
    <div class="user-page">

    <div class="user">
        <div class="user-icon-info">
            <?php 
            if ($userImg != null) {
                echo '<img src="' . $userImg . '" alt="user-img">' ;
            }
            else { ?>
                <i class="fas fa-user"></i>
            <?php } ?>

            <h2> <?= $username ?> </h2>
            <h3> up<?= $up ?> </h3>
            <h4> <?= $userType ?> </h4>
        </div>

        <div class="user-info">
            <h4> User Email: <?= $userEmail ?> </h4>
            <h4> This user joined at: <?= $date ?> </h4> 
            <h4> Departments: </h4>
            <ul>
            <?php if ($userType != 'Student') {
                for ($i = 0; $i < count($userDepartments); $i++) { ?>
                    <li><h4> <?= $userDepartments[$i] ?> </h4></li>
            <?php }
            } ?>
            </ul>

        </div>

        <div class="links">
            <?php
                echo '<a href="../pages/tickets.php?up=' . $up . '"> User Tickets <i class="fas fa-ticket-alt"></i></a>';
            ?>
            <a href ="../pages/home.php"> Sign Out <i class="fas fa-sign-out-alt"></i></a>
            <a href="../pages/edit_user.php?up=<?= $up ?>"> Edit Info <i class="fas fa-edit"></i></a>
        </div>
    </div> 
    </div>
    

<?php } 


function drawUsersBody($users){ ?>

    <div class="staff-page">
        <div class="users-body">
            <input id="searchuser" type="text" placeholder="Search for an user">

            <div class="table">
                <table>

                    <thead>

                        <th><h2> User </h2></th>
                        <th><h2> Up </h2></th>
                        <th><h2> Email </h2></th>

                    </thead>

                    <tbody id="table-box">
                        
                        <?php foreach($users as $user){ ?>

                            <tr>

                                <td>
                                    <h2><?= $user->name ?></h2>
                                    <h3><?= $user->role ?></h3>
                                </td> 

                                <td> <h3><?= $user->up?> </h3></td>

                                <td> <h3><?= $user->email?>  </h3></td>


                                <td>

                                    <i class="fas fa-search"></i> 
                                    <i class="fas fa-edit"></i>
                                    <i class="fas fa-trash-alt"></i>

                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>

            </table>
            </div>

        </div>
    </div>
        

<?php } ?>
