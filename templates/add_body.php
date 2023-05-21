<?php
function drawAddBody() {
    ?>
    <section class="add-page">

        <form action="../actions/add_department.php?name=" class="add-department">
            <label for="name">Department Name:</label>
            <input type="text" name="name" id="name">
            <p class="errorMessage"></p>
            <button type="submit"><i class="fas fa-plus"></i> Add Department </button>
        </form>


        <form action="../actions/add_status.php" class="add-status">
            <label for="status-name">Status Name:</label>
            <input type="text" name="name" id="status-name">
            <p class="errorMessage"></p>
            <button type="submit"><i class="fas fa-plus"></i> Add Status </button>
        </form>
    </section>

<?php }

?>

