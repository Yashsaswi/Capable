<?php
    session_start();
    require 'conn.php';

    if(isset($_SESSION['user'])) {
        ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Capable | Console</title>
        <link rel="stylesheet" href="Styles/Style.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Poppins&display=swap" rel="stylesheet">
    </head>
    <body>
    <header>
        <a href="index.php">
            <h1><b>Capable</b></h1>
        </a>
        <nav>
            <ul id ="navigation">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="aboutus.php">About us</a></li>
                <li><a href="contactus.php">Contact us</a></li>
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
    <main>
        <div class="sec-title">
            <h2>Your Posts</h2>
        </div>
        <?php
            $id = $_SESSION['u_id'];
            $stm1 = 'SELECT * FROM jobs WHERE u_id=?';
            $sql = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($sql, $stm1);
            mysqli_stmt_bind_param($sql, "d", $id);
            mysqli_stmt_execute($sql);
            $result = mysqli_stmt_get_result($sql);

            while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            ?>
            <div class="jobs-container" name="job-post">
                <div class="title">
                    <h2><?php echo $row['job_title']; ?></h2>
                    <h4><?php echo $row['company']; ?> • <?php echo $row['location']; ?></h4>
                </div>
                <div id="left" class="grid-left">
                    <h4></h4>
                    <h4><?php echo $row['salary']; ?></h4>
                    <h4><?php echo $row['user_email']; ?></h4>
                    <h4><?php echo $row['user_contact']; ?></h4>
                </div>
                <div class="grid-right">
                    <p><?php echo $row['description']; ?></tr>
                </div>
                <div class="grid-button">
                    <form action="applicants.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['job_id']; ?>">
                        <input type="submit" value="View applicants">
                    </form>
                </div>
            </div>
        <?php
            }
        ?><br>
        <div class="sec-title">
            <h2>Your Applications</h2>
        </div>
        <?php
            $stm1 = 'SELECT * FROM applications WHERE u_id=?';
            mysqli_stmt_prepare($sql, $stm1);
            mysqli_stmt_bind_param($sql, "d", $id);
            mysqli_stmt_execute($sql);
            $res = mysqli_stmt_get_result($sql);
            //$val = mysqli_fetch_array($res);

            //<<Temp comment by yash for job list solution
            $array = array();
            while($r = mysqli_fetch_array($res, MYSQLI_BOTH)) {
                $j_id = $r[2];
                array_push($array,$j_id);
            }

            if(!empty($array)) {
                $query = mysqli_query($conn,  'SELECT * FROM jobs WHERE job_id IN ('.implode(',',$array).')');

                while($row = mysqli_fetch_array($query,MYSQLI_BOTH))
                {

            //     }
            // }
            //>>
            //$stm = 'SELECT * FROM jobs WHERE job_id=?';
            // mysqli_stmt_prepare($sql, $stm);
            // mysqli_stmt_bind_param($sql, "d", $val['j_id']);
            // mysqli_stmt_execute($sql);
            // if($result = mysqli_stmt_get_result($sql)) {
            //     while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        ?>
                    <div class="jobs-container" name="job-post">
                        <div class="title">
                            <h2><?php echo $row['job_title']; ?></h2>
                            <h4><?php echo $row['company']; ?> • <?php echo $row['location']; ?></h4>
                        </div>
                        <div id="left" class="grid-left">
                            <h4></h4>
                            <h4><?php echo $row['salary']; ?></h4>
                            <h4><?php echo $row['user_email']; ?></h4>
                            <h4><?php echo $row['user_contact']; ?></h4>
                        </div>
                        <div class="grid-right">
                            <p><?php echo $row['description']; ?></tr>
                        </div>
                    </div>
        <?php
                }
            } else {
                mysqli_error($conn);
            }
        ?>
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
                <li><a href="contactus.php">Contact Us</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>
        <div class="footer-copyright">
            <small class="copy">All Content Copyright 2024 - Capable. All Rights Reserved</small>
        </div>
    </footer>
    </body>
    </html>
        <?php
    } else {
        header('Location: index.php');
    }
