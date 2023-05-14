<?php
require_once(__DIR__ . '/../database/ticket.class.php');
function drawTicket(Ticket $ticket){
    ?>
    <div class="ticketContainer">
        <div class="user-info">
            <img src="../docs/images/feup.png">
            <h3><?= $ticket->client->name?></h3>
            <p>Up<?= $ticket->client->up?></p>
        </div>
        <div class="subject">
            <p><?= $ticket->title?></p>
        </div>
        <div class="department">
            <p><?= $ticket->department?></p>
        </div>
        <div class="status">
            <p><?= $ticket->status?></p>
        </div>
    </div>

    <?php
}
function drawTicketSection(array $tickets,string $title){

?>
    <div class="ticketSection">
   <h2><?=$title?></h2>
        <?php
            foreach ($tickets as $ticket)
                drawTicket($ticket);
        ?>
    </div>
    <?php
}


?>

