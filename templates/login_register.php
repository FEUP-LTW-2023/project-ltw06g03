<?php function drawLogin() {?>

    <div class="loginRegisterForm" name="LoginForm">
        <form class="loginForm">
            <h3>Login</h3>
            <label>
            <input  type="text" placeholder="Up" required>
            </label>
            <label>
            <input type="password" placeholder="Password" required>
            </label>
            <p class="errorMessage"></p>
            <button name="CancelLogin" >Cancel</button>
            <button name="Login">Login</button>
        </form>
    </div>
<?php } ?>

<?php function drawRegister() {?>

    <div class="loginRegisterForm" name="RegisterForm" >
        <form class="registerForm" method="post" action="../database/register.php">
            <h3>Register</h3>
            <label >
                <input  type="text" placeholder="Up" required name="up">
            </label>
            <label>
                <input  type="text" placeholder="Name" required name="name">
            </label>
            <label>
                <input  type="email" placeholder="Alternative Email" name="email">
            </label>
            <label>
                <input type="password" placeholder="Password" required name="pass">
                <i class="fas fa-eye"></i>
            </label>
            <label>
            <input type="password" placeholder="Confirm Password" required name="pass">
                <i class="fas fa-eye"></i>
            </label>
            <p class="errorMessage"></p>
            <button name="CancelRegister" >Cancel</button>
            <button name="Register" type="submit">Register</button>
        </form>
    </div>


<?php } ?>
