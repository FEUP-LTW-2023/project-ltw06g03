<?php
function headerStart(){ ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Feup Trouble Ticket's</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
<?php }
function headerEnd(){ ?>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
<?php }
function drawHomePageHeader(){
    headerStart();
    ?>

    <link rel="stylesheet" href="../css/home_page_styles.css">
    <link rel="stylesheet" href="../css/login_register_styles.css">
<?php
    headerEnd();
} ?>


<?php function drawLoginPageHeader(){
    headerStart();
    ?>

    <link rel="stylesheet" href="../css/login_register_styles.css">
    <script src="../javascript/login.js" defer type="module"></script>
<?php
    headerEnd();
} ?>

<?php function drawRegisterPageHeader(){
    headerStart();
    ?>

    <link rel="stylesheet" href="../css/login_register_styles.css">
    <script src="../javascript/register.js" defer type="module"></script>
<?php
    headerEnd();
} ?>

<?php function drawProfileHeader(){
    headerStart();
    ?>

        <link rel="stylesheet" href="../css/profile_page_styles.css">
        <link rel="stylesheet" href="../css/ticket.css">
    <script  type="module" src="../javascript/user.js" defer></script>
<?php
    headerEnd();
} ?>

<?php function drawUsersHeader(){
    headerStart();
    ?>

    <link rel="stylesheet" href="../css/users_page_styles.css">
    <script src="../javascript/searchUser.js" defer></script>
    <script src="../javascript/editRole.js" defer type="module"></script>
    <script src="../javascript/editDepartment.js" defer type="module"></script>

<?php
    headerEnd();
} ?>

<?php function drawEditHeader(){
    headerStart();
    ?>

    <link rel="stylesheet" href="../css/edit.css">

    <script src="../javascript/editUser.js" defer type="module"></script>

<?php
    headerEnd();
}?>
<?php function drawTicketHeader(){
    headerStart();
    ?>

     <link rel="stylesheet" href="../css/ticket_page.css">
    <link rel="stylesheet" href="../css/ticket.css">
    <script src="../javascript/tickets_page.js" type="module" ></script>

<?php

    headerEnd();
}?>


<?php function drawAddPageHeader() {
    headerStart();
    ?>

    <link rel="stylesheet" href="../css/add.css">

    <script src="../javascript/addFields.js" defer type="module"></script>

<?php
    headerEnd();
} ?>
<?php function drawFaqPageHeader() {
    headerStart();
    ?>

    <link rel="stylesheet" href="../css/faq.css">
    <script src="../javascript/addFields.js" defer type="module"></script>


<?php
    headerEnd();
} ?>

