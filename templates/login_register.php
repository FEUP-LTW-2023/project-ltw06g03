<?php function drawLogin() {?>

    <div id="loginRegister">
        <form>
            <h3>Login</h3>
            <input  type="text" placeholder="Up" required>
            <input type="password" placeholder="Password" required>
            <button name="Cancel">Cancel</button>
            <button name="Login">Login</button>
        </form>
    </div>
<?php } ?>

<?php function drawRegister() {?>
    <script></script>
    <div id="loginRegister">
        <form>
            <h3>Register</h3>
            <input  type="text" placeholder="Up" required>
            <input  type="text" placeholder="Name" required>
            <input  type="email" placeholder="Alternative Email">
            <input type="password" placeholder="Password" required>
            <input type="password" placeholder="Confirm Password" required >
            <button name="Cancel">Cancel</button>
            <button name="Register">Register</button>
        </form>
    </div>

<?php } ?>
