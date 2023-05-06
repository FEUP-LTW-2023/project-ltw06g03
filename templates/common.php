
<?php 
  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeader(Session $session) { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>FEUP TROUBLE TICKETS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="../css/responsive_style.css">

    <script src="../javascript/script.js" defer></script>
  </head>
  <body>

    
<?php } ?>

<?php function drawFooter() { ?>
    </main>

    <footer>
    FEUP TROUBLE TICKETS &copy; 2022
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawNavBar(Session $session) { ?>

    <div class="navbar">

        <input type="checkbox" id="hamburger" >

        <div class="items">
        <ul class="navbar-top">
            <li><label class="hamburger" for="hamburger" content="\2630"></label></li>
            <li><a href="home.php"><img src="../docs/home.png" alt="Home"><span>Home<span</a></li>

            <?php if($session->isLoggedIn()) {?>
                <li><a href="tickets.php"><img src="../docs/inbox.png" alt="Tickets"><span>Tickets</span></a></li>

                <?php if($session->isStaff()) {?>
                    <li><a href="staff.php"><img src="../docs/people.png" alt="Staff"><span>Staff</span></a></li>
                    
                    <?php if($session->isAdmin()) { ?>
                        <li><a href="statistics.php"><img src="../docs/analytics.png" alt="Admin"><span>Statics</span></a></li>
                    <?php } ?>

                <?php } ?>
            
            <?php } ?>
            
        </ul>

        <ul class ="navbar-bottom">
            
            <li> 
                <?php if($session->isLoggedIn()) {?>
                    <a href="profile.php"><img src="../docs/usr.png" alt="Profile"><span>Profile<span></a>
                <?php } else { ?>
                    <a href="login.php"><img src="../docs/usr.png" alt="Login"><span>Login</span></a>
                <?php } ?>
            </li>
            
        </ul>
        </div>
    </div>
    
    <main>

<?php } ?>
