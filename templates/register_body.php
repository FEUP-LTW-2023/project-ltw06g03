<?php

function drawRegister() {?>

    <section class="loginRegisterForm" name="RegisterForm" >
        <form class="registerForm" method="post" action="../actions/register.php">
            <a href="../pages/home.php"><i class="fa fa-home"></i> Go to Home</a>
            <h3>Register</h3>
            <label >
                <h4>Up</h4><input  type="number" placeholder="xxxxxxxxx" required name="up">
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
            <a href="../pages/login.php">Already have an account?</a>
            <button name="Register" type="submit">Register</button>
        </form>
    </section>


<?php } ?>
