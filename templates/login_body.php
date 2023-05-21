<?php
function drawLogin() {?>

    <section class="loginRegisterForm" name="LoginForm" >
        <form class="loginForm"  >
            <a href="../pages/home.php"><i class="fa fa-home"></i> Go to Home</a>
            <h3>Login</h3>
            <label>
                <h4>Up</h4><input  type="number" placeholder="xxxxxxxxx" required name="up">
            </label>
            <label>
                <input type="password" placeholder="Password" required name="pass">
                <i class="fas fa-eye"></i>
            </label>
            <p class="errorMessage"></p>
            <a href="../pages/register.php">Don't have an account?</a>

            <button>Login</button>
        </form>
    </section>
<?php } ?>
