<?php
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
<?php } ?>

