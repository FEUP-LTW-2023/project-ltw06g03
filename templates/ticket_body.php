<?php
function drawTicketBody($session){?>
    <section class="ticket-page">
        <section class="menu">
            <header><h3>Tickets</h3><button>+ New Ticket</button> </header>
            <form class="searchbar"><i class="fas fa-search"></i><input type="text"></form>
            <aside>
                <ul>
                    <li class="selected">All Tickets</li>
                </ul>
                <ul>
                    <li>My Tickets</li>
                    <li>Open Tickets</li>
                    <li>Closed Tickets</li>
                </ul>
                <?php if($session->isStaff()){  ?>
                    <ul>
                        <li>Assigned Tickets</li>
                        <li>Solved Tickets</li>
                    </ul>
                <?php } ?>
            </aside>
        </section>
        <section class="tickets">
            <section class="topBar">
                <header></header>
                <section class="filters"></section>
            </section>
            <section class="ticketSection"></section>
        </section>
    </section>
<?php }

?>
