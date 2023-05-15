<?php
require_once(__DIR__ . '/../database/ticket.class.php');
function drawTicket(Ticket $ticket){
    ?>
    <div class="ticketContainer" id="<?=$ticket->id?>">
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
function drawExpandedTicket(Ticket $ticket){

?>
<div class="expandedTicket">
    <header >
        <h2><?= $ticket->title?></h2>
        <button>X</button>
        <div class="status"><p><?=$ticket->status?></p></div>
    </header>
    <div class="extra-inf">
        <div class="department"> <h5>Department</h5> <p><?=$ticket->department?></p></div>
        <div class="assigns"> <h5>Assigns</h5> <p><?=$ticket->department?></p></div>
    </div>
    <div class="about">
        <div class="user-info">
            <img src="../docs/images/feup.png">
            <h3 > <?= $ticket->client->name?></h3>
            <p>Up<?= $ticket->client->up?></p>
        </div>
        <p> <?= $ticket->problem?></p>
    </div>
    <div class="messages">
        <div class="message">
            <div class="user-info">
                <img src="../docs/images/feup.png">
                <h3 > <?= $ticket->client->name?></h3>
                <p>Up<?= $ticket->client->up?></p>
            </div>
            <p class="text">Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.</p>
        </div>
        <div class="message">
            <div class="user-info">
                <img src="../docs/images/feup.png">
                <h3 > <?= $ticket->client->name?></h3>
                <p>Up<?= $ticket->client->up?></p>
            </div>
            <p class="text">Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.</p>
        </div>
        <div class="message">
            <div class="user-info">
                <img src="../docs/images/feup.png">
                <h3 > <?= $ticket->client->name?></h3>
                <p>Up<?= $ticket->client->up?></p>
            </div>
            <p class="text">Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.</p>
        </div>
        <div class="message">
            <div class="user-info">
                <img src="../docs/images/feup.png">
                <h3 > <?= $ticket->client->name?></h3>
                <p>Up<?= $ticket->client->up?></p>
            </div>
            <p class="text">Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.Here is some random text for you to read, it's really useless.</p>
        </div>

    </div>

</div>

<?php } ?>
