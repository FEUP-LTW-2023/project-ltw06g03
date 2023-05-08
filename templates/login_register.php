<?php function drawLogin() {?>

    <div class="loginRegisterForm" name="LoginForm">
        <form class="loginForm">
            <h3>Login</h3>
            <input  type="text" placeholder="Up" required>
            <input type="password" placeholder="Password" required>
            <button name="CancelLogin" >Cancel</button>
            <button name="Login">Login</button>
        </form>
    </div>
<?php } ?>

<?php function drawRegister() {?>

    <div class="loginRegisterForm" name="RegisterForm" >
        <form class="registerForm" method="post" action="../database/register.php">
            <h3>Register</h3>
            <input  type="text" placeholder="Up" required name="up">
            <input  type="text" placeholder="Name" required name="name">
            <input  type="email" placeholder="Alternative Email" name="email">
            <input type="password" placeholder="Password" required name="pass">
            <input type="password" placeholder="Confirm Password" required>
            <button name="CancelRegister" >Cancel</button>
            <button name="Register" type="submit">Register</button>
        </form>
    </div>


<?php } ?>
