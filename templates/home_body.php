<?php

function drawHomeBody(){
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/faqs.php');
    $session = new Session();
    ?>

    <section class="homePageHeader">
        <?php if(!$session->isLoggedIn()){?>
            <section class="loginRegister">
                <a  href="../pages/register.php">Register</a>
                <a href="../pages/login.php">Login</a>
            </section>
        <?php }?>
        <header>
            <h1>Feup Trouble Ticket's</h1>
            <h2>Create tickets for your problems</h2>

        </header>
        <div class="indicator">
            <a href="#about"><i class='fas fa-angle-down'></i></a>
            <a href="#about"><i class='fas fa-angle-down'></i></a>
            <a href="#about"><i class='fas fa-angle-down'></i></a>
        </div>

    </section>
    <section class="about" id="about">
        <h1>About FTT</h1>
        <article>
            <div class="Text">
                <header><h3>What is FTT?</h3></header>

                <p>FTT, short for Feup Trouble Ticket, is an innovative website developed by two students from FEUP (Faculty of Engineering, University of Porto). Its primary objective is to streamline the process of problem-solving for students by providing a user-friendly platform. FTT aims to eliminate the need for students to physically visit the university and spend precious time searching for assistance. Instead, they can leverage the convenience of the website to create support tickets and receive prompt help from designated staff members.</p></div>
            <img src="../docs/images/tickets.png">

        </article>
        <article>
            <div class="Text">
                <header><h3>How does it work?</h3></header>

                <p>Using FTT is remarkably simple and efficient. To get started, you create a ticket and associate it with the relevant department that aligns with your specific issue. When creating a ticket, it is important to provide a concise title and a clear description of the problem you are facing. Don't worry if you mistakenly select the wrong department; the system is designed to automatically rectify any misclassifications and assign your ticket to the appropriate staff member. Once your ticket is generated, a dedicated staff member will be assigned to assist you, and they will reach out to communicate and work towards resolving your problem. You can expect timely responses and updates throughout the process. Once your problem is successfully resolved, your ticket will be marked as closed, signifying the completion of the support process.</p></div>
            <img src="../docs/images/ticket_being_resolved.png">

        </article>
        <article>
            <div class="Text">
                <header><h3>How can I create a ticket?</h3></header>

                <p>To create a ticket on FTT, you will need to log in to your account. In the event that you don't have an account yet, the registration process is straightforward and quick. Upon logging in, you will find the ticket option conveniently located in the navigation bar. By clicking on the ticket option, you will be directed to a dedicated page displaying your existing tickets and providing access to various ticket-related functions. From there, simply click on the "New Ticket" button, which will initiate the creation process. You will be presented with a well-designed form where you can input the necessary details pertaining to your issue. Take care to provide accurate and concise information to ensure a prompt and accurate response. Once you have filled out the form, click the "Submit Ticket" button, and your ticket will be successfully submitted for review and assistance.</p></div>
            <img src="../docs/images/ticket_create.png">

        </article>
    </section>



    <?php

}?>
