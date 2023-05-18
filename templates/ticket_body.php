<?php
function drawTicketBody($session){?>
    <section class="ticket-page">
        <section class="menu">
            <header><h3>Tickets</h3><button>+ New Ticket</button> </header>
            <form class="searchbar"><i class="fas fa-search"></i><input type="text"></form>
            <aside>
                <ul>
                    <li class="selected">All Tickets</li>
                    <li>Open Tickets</li>
                    <li>Closed Tickets</li>
                </ul>
                <ul>
                    <li>My Tickets</li>
                    <li>My Open Tickets</li>
                    <li>My Closed Tickets</li>
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
                <header class="topBar"><h3>My tickets</h3></header>

        </section>
        <section class="newTicket">
            <header class="topBar"><h3>New Ticket</h3></header>
            <form>
                <input type="text" placeholder="Short Title">
                <textarea placeholder="Description of the problem"></textarea>
                <p class="errorMessage"></p>
                <button>Cancel</button>
                <button>Submit Ticket</button>
            </form>

        </section>
    </section>
<?php }

function draw(){?>
    <div class="ticketContainer" >
                    <div class="user-info">
                        <img src="../docs/images/feup.png">
                        <h3>Francisco</h3>
                        <p>Up10</p>
                    </div>
                    <div class="subject">
                        <p>I have a big problem</p>
                    </div>
                    <div class="department">
                        <p></p>
                    </div>
                    <div class="status">
                        <p>open</p>
                    </div>
                </div>
<?php }

?>
