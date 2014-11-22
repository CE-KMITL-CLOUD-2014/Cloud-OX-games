<?php require_once("session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Online board game</title>
    <link href="/Styles/Site.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<div class="outer-wrapper">
    <header>
        <div class="content-wrapper">
            <div class="float-left">
                <p class="site-title"><a href="/index.php">Online board game</a></p>
            </div>
            <div class="float-right">
                <section id="login">
                    <ul id="login">
                        <?php
                        if (isset($_SESSION['userid'])) {
                            ?>
                            <li>You login as <?php echo $_SESSION['name'] ?></li>
                            <li><a href="/logoff.php">Sign out</a></li><?php
                        } else {
                            ?>
                            <li><a href="/logon.php">Login</a></li>
                            <li><a href="/register.php">Register</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </section>
            </div>

            <div class="clear-fix"></div>
        </div>

        <section class="navigation" data-role="navbar">
            <nav>
                <ul id="menu">
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="/play.php">Play</a></li>
                    <li><a href="/chat.php">Chat</a></li>
                </ul>
            </nav>
        </section>
    </header>
