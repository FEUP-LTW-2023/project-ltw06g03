<?php
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
                            <div class="departments">
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
                            </div>
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

    </section>
        <?php if($session->isAdmin()) {?>
            <div class="add-buttons">
                <button><a href="../pages/addFields.php"><i class="fas fa-plus"></i>  Add Department or Status </a></button>
            </div>
        <?php }?>

    </section>



<?php } ?>