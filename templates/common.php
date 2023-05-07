
<?php 
  require_once(__DIR__ . '/../utils/session.php');
?>



<?php function drawFooter() { ?>
    <footer>
        <div class="row">
            <div class="col">
                <img src="../docs/images/logo_feup.png">
                <p>Website created by two FEUP students with the purpose of helping other students. </p>
            </div>
            <div class="col">
                <h3>FEUP</h3>
                <p>R. Dr. Roberto Frias</p>
                <p>4200-465 Porto</p>
                <h4>feuptt@gmail.com</h4>
                <h4>22 508 1977 / 1405</h4>
            </div>
            <div class="col">
                <h3>Links</h3>
                <ul>
                    <li><a>Home</a></li>
                    <li><a>Feup Official</a></li>
                    <li><a>Source code</a></li>
                    <li><a>About us</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Send us Feedback</h3>
                <form>
                    <i class='fas fa-envelope'></i>
                    <input type="email" placeholder="email" required>
                    <button type="submit"><i class='fas fa-arrow-right'></i></button>
                </form>
            </div>
        </div>
        <div class="row">
            <p class="copyRight">All CopyRights rights reserved by &#169; Feup </p>
        </div>


    </footer>
  </body>
</html>
<?php } ?>

<?php function drawNavBar(Session $session) { ?>

    <div class="navbar">

        <input type="checkbox" id="hamburger" >

        <div class="items">

        <ul class="navbar-top">
            <label class="hamburger" for="hamburger" content="\2630"></label>
            <li><a href="home.php"><img src="../docs/icons/home.png" alt="Home"><span>Home<span</a></li>

            <?php if($session->isLoggedIn()) {?>
                <li><a href="tickets.php"><img src="../docs/icons/inbox.png" alt="Tickets"><span>Tickets</span></a></li>

                <?php if($session->isStaff()) {?>
                    <li><a href="staff.php"><img src="../docs/icons/people.png" alt="Staff"><span>Staff</span></a></li>
                    
                    <?php if($session->isAdmin()) { ?>
                        <li><a href="statistics.php"><img src="../docs/icons/analytics.png" alt="Admin"><span>Statics</span></a></li>
                    <?php } ?>

                <?php } ?>
            
            <?php } ?>
            
        </ul>

        <ul class ="navbar-bottom">
            
            <li> 
                <?php if($session->isLoggedIn()) {?>
                    <a href="profile.php"><img src="../docs/icons/usr.png" alt="Profile"><span>Profile</span></a>
                <?php } else { ?>
                    <a href="login.php"><img src="../docs/icons/usr.png" alt="Login"><span>Login</span></a>
                <?php } ?>
            </li>
            
        </ul>
        </div>
    </div>


<?php } ?>
