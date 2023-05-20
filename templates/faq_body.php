<?php function drawFaqBody(){
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/doubt.class.php');
    $db = getDatabaseConnection();
    $doubts = Doubt::getDoubts($db);
    ?>
<section class="page">
    <form action="../actions/add_faq.php">
        <h4>Create Faq</h4>
        <label for="title"><h5>Tile</h5></label>
        <input type="text" required id="title" name="title">
        <label for="text"><h5>Text</h5></label>
        <textarea type="text" required id="text" name="text"></textarea>
        <input type="submit" value="Submit">
    </form>
    <section class="doubts">
        <header><h3>Doubts</h3></header>
        <?php
        foreach ($doubts as $doubt){?>
            <article class="doubt">
                <p><?= $doubt->text ?></p>
            </article>
        <?php }
        ?>
    </section>
</section>

<?php } ?>
