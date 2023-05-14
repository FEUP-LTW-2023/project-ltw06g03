<?php 

function drawUserBody($session) {
    $_up= $_GET['up'];
    if($_up==null) $_up=8;
    
    $up = $session->getUp();
    $username = $session->getUsername();
    $userType = $session->getUserType();
    $userEmail = $session->getEmail();
    $userDepartments = $session->getDepartments();
    $date = $session->getDateOfRegister();
    $userImg = $session->getUserImg();

    require_once('../templates/tickets.php');
    require_once ("../database/user.class.php");
    $tickets = array(
        new Ticket(
            $_up,
            'Can not enter sigarra for some unkownddjsgdfsgdfgsjdhafs',
            new User($_up,'Francisco Cardoso','franciscocardsdfsdfoso.3003@gmail.com','st','asd'),
            'open',
            'cica',
            "Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless."
        ),
        new Ticket(
            202108793,
            'ola',
            new User(202108793,'Fr','gr','st','asd'),
            'das',
            'asd',
            'problem'
        ),
    );
    
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

            <h2> <?php echo $username ?> </h2>
            <h3> up<?php echo $up ?> </h3>
            <h4> <?php echo $userType ?> </h4>
        </div>

        <div class="user-info">
            <h4> User Email: <?php echo $userEmail ?> </h4>
            <h4> This user joined at: <?php echo $date ?> </h4> 
            <h4> Departments: </h4>
            <ul>
            <?php if ($userType != 'Student') {
                for ($i = 0; $i < count($userDepartments); $i++) { ?>
                    <li><h4> <?php echo $userDepartments[$i] ?> </h4></li>
            <?php }
            } ?>
            </ul>

        </div>

        <div class="links">
            <?php
                echo '<a href="../pages/tickets.php?up=' . $up . '"> User Tickets <i class="fas fa-ticket-alt"></i></a>';
            ?>
            <a href ="../pages/home.php"> Sign Out <i class="fas fa-sign-out-alt"></i></a>
            <a href="../pages/edit_user.php?up=<?php echo $up ?>"> Edit Info <i class="fas fa-edit"></i></a>
        </div>
    </div> 
    

<?php drawTicketSection($tickets,"My Tickets");
drawExpandedTicket($tickets[0]);
?>
    </div>
<?php } ?>


