<?php function drawLogin() {?>

    <div class="loginRegisterForm" name="LoginForm">
        <form class="loginForm">
            <h3>Login</h3>
            <input  type="text" placeholder="Up" required>
            <input type="password" placeholder="Password" required>
            <button name="Cancel" onclick="cancel(0)">Cancel</button>
            <button name="Login">Login</button>
        </form>
    </div>
<?php } ?>

<?php function drawRegister() {?>

    <div class="loginRegisterForm" name="RegisterForm" >
        <form class="registerForm">
            <h3>Register</h3>
            <input  type="text" placeholder="Up" required>
            <input  type="text" placeholder="Name" required>
            <input  type="email" placeholder="Alternative Email">
            <input type="password" placeholder="Password" required>
            <input type="password" placeholder="Confirm Password" required >
            <button name="Cancel" onclick="cancel(1)">Cancel</button>
            <button name="Register">Register</button>
        </form>
    </div>


<?php } ?>
