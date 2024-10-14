<?php
    session_start();
    ?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Capable | About</title>
        <link rel="stylesheet" href="Styles/Style.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Poppins&display=swap" rel="stylesheet">
        <style>
        body {
            background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(Icons/img2.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>
    </head>
    <body>
    <header>
        <a href="index.php">
            <h1><b>Capable</b></h1>
        </a>
        <nav>
            <ul id ="navigation">
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About us</a></li>
                <li><a class="active" href="Contact us.php"> Contact us </a></li>
                <?php
                    if(!isset($_SESSION['user'])) {
                        echo '<li id="login"><a href="signIn.php"><img src="Icons/user-solid.svg"></a>';
                    } else {
                        echo '<li id="logout"><a href="console.php">', $_SESSION['user'] ,'</a><ul></li><li><a href="console.php">My console</a></li><li id="logout"><a href="logOut.php">Log out</a></li></ul></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>
    <main class="about">
        <h1>ENQUIRE NOW</h1>
        <!--<div class="ps"></div><br><p>Capable is a web application for searching, browsing and applying for jobs for your preferred field and location</p><div class="ps"></div><br>-->
    
                <!--temp comment by Yashsaswi -->
                <h2> Mumbai Office:</h2>
                <div>105,106 <br> Veera Desai Road, Azad Nagar, <br> Andheri West, Mumbai 400056, Maharashtra</div>
                <!-- //-->
    </main>
    <footer class="page-footer">
    <div class="left">
        <h5>Capable</h5>
        <p>Let us help you excel</p>
    </div>
    <div class="right">
        <h5>Useful Links</h5>
        <ul>
            <li><a href="index.php">Homepage</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </div>
    <div class="footer-copyright">
        <small class="copy">All Content Copyright 2024 - Capable. All Rights Reserved</small>
    </div>
</footer>
    </body>
    </html>