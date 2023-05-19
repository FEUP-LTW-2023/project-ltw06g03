<?php
function drawTicketBody($session){
    if(!isset($_GET['op']) or !is_numeric($_GET['op']) or ($_GET['op']>=6 and !$session->isStaff()) ) header('Location: tickets.php?op=0');
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/department.class.php');
    $db = getDatabaseConnection();
    $departments = Department::getDepartments($db);

    ?>

    <section class="ticket-page">
        <section class="menu">
            <header><h3>Tickets</h3><button>+ New Ticket</button> </header>
            <form class="searchbar"><i class="fas fa-search"></i><input type="text"></form>
            <aside>
                <ul>
                    <li ><a href="../pages/tickets.php?op=0">All Tickets</a></li>
                    <li><a href="../pages/tickets.php?op=1">Opened Tickets</a></li>
                    <li><a href="../pages/tickets.php?op=2">Closed Tickets</a></li>
                </ul>
                <ul>
                    <li><a href="../pages/tickets.php?op=3">My Tickets</a></li>
                    <li><a href="../pages/tickets.php?op=4">My Opened Tickets</a></li>
                    <li><a href="../pages/tickets.php?op=5">My Closed Tickets</a></li>
                </ul>
                <?php if($session->isStaff()){  ?>
                    <ul>
                        <li><a href="../pages/tickets.php?op=6">Assigned Tickets</a></li>
                        <li><a href="../pages/tickets.php?op=7">Solved Tickets</a></li>
                    </ul>
                <?php } ?>
            </aside>
        </section>
        <section class="tickets">
                <header class="topBar"><h3>My tickets</h3></header>

        </section>
        <section class="newTicket">
            <header class="topBar"><h3>New Ticket</h3></header>
            <div>
                <form>
                    <input type="text" placeholder="Short Title">
                    <textarea placeholder="Description of the problem"></textarea>
                    <p class="errorMessage"></p>
                    <button>Cancel</button>
                    <button>Submit Ticket</button>
                </form>
                <section class="department">
                    <label for="department">Chose Department: </label>
                    <select id="department" name="department" >
                        <option></option>
                        <?php
                            foreach ($departments as $department){
                        ?>
                        <option><?= $department?></option>
                        <?php } ?>
                    </select>
                </section>
            </div>

        </section>
    </section>
<?php }

?>
