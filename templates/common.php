
<?php 
  require_once(__DIR__ . '/../utils/session.php');

?>



<?php function drawFooter() { ?>
    <footer>
        <div class="row">
            <div class="col">
                <img src="../docs/logo-feup.png">
                <p>Feup is an engineering faculty from the University of Porto located in Portugal</p>
            </div>
            <div class="col">
                <h3>FEUP<div class="underline"><span></span></div></h3>
                <p>R. Dr. Roberto Frias</p>
                <p>4200-465 Porto</p>
                <h4>feuptt@gmail.com</h4>
                <h4>22 508 1977 / 1405</h4>
            </div>
            <div class="col">
                <h3>Links<div class="underline"><span></span></div></h3>
                <ul>
                    <li><a>Home</a></li>
                    <li><a>Feup Official</a></li>
                    <li><a>Source code</a></li>
                    <li><a>About us</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Send us Feedback<div class="underline"><span></span></div></h3>
                <form >
                    <i class='fas fa-envelope' alt="d"></i>
                    <textarea type="email" placeholder="email" required></textarea>
                    <button type="submit"><i class='fas fa-arrow-right'></i></button>
                </form>
            </div>
        </div>
        <div class="row">
            <p class="copyRight">All CopyRights rights reserved by &#169; Feup </p>
        </div>


    </footer>
    </main>
  </body>
</html>
<?php } ?>

<?php function drawNavBar(Session $session) { ?>

    <div class="navbar">

        <input type="checkbox" id="hamburger" >

        <div class="items">

        <ul class="navbar-top">
            <label class="hamburger" for="hamburger" content="\2630"></label>
            <li><a href="../pages/home.php"><i class="fa fa-home"></i><span>Home<span</a></li>

            <?php if($session->isLoggedIn()) {?>
                <li><a href="tickets.php"><i class="fa fa-ticket" ></i><span>Tickets</span></a></li>

                <?php if($session->isStaff()) {?>
                    <li><a href="users.php"><i class="fas fa-users"></i><span>Users</span></a></li>

                <?php } ?>
            
            <?php } ?>
            
        </ul>

        <ul class ="navbar-bottom">
            
            <li> 
                <?php if($session->isLoggedIn()) {?>
                    <a href="../pages/profile.php?up=<?=$session->getUp()?>"><i class="fas fa-user"></i><span>Profile</span></a>
                <?php } else { ?>
                    <a href="../pages/login.php"><i class="fas fa-user"></i><span>Login</span></a>
                <?php } ?>
            </li>
            
        </ul>
        </div>
    </div>
    <main>


<?php } ?>
