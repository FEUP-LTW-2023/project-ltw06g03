<?php 

function drawUserBody($session) {
    
    $up = $session->getUp();
    $username = $session->getUsername();
    $userType = $session->getUserType();
    $userEmail = $session->getEmail();
    $userDepartments = $session->getDepartments();
    $date = $session->getDateOfRegister();

    $userImg = $session->getUserImg();
    header("Content-type: image/png");
    echo $userImg;
    
    ?>

    <div class="user-info">
        <?php 
        if ($userImg != null) {
            echo '<img src="' . $_SERVER['PHP:SELF'] . '" alt="user-img">' ;
        }
        else { ?>
            <img src="../images/user.png" alt="user-img">
        <?php } ?>
         
        <h2> <?php echo $up ?> </h2>
        <h3> <?php echo $username ?> </h3>
        <h4> <?php echo $userEmail ?> </h4>
        <h4> <?php echo $userType ?> </h4>
        <h4> <?php echo $date ?> </h4>
        <ul>
        <?php if ($userType != 'Student') {
            for ($i = 0; $i < count($userDepartments); $i++) { ?>
                <h4> <?php echo $userDepartments[$i] ?> </h4>
        <?php }
        } ?>
        </ul>

        <?php
            echo '<a href="../pages/tickets.php?up=' . $up . '"> User Tickets </a>';
        ?>
    </div> 
    

<?php } ?>