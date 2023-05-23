<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Error - BunkoDEX</title>
    <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        blink {
            animation: 2s linear infinite condemned_blink_effect;
        }

        @keyframes condemned_blink_effect {
            0% {
                visibility: visible;
            }

            50% {
                visibility: hidden;
            }

            100% {
                visibility: hidden;
            }
        }
    </style>
</head>

<body bgcolor="#000000">
    <center>
        <blink>
            <h1 style='color: #ff0000; font-size: 78px'>ERROR!</h1>
        </blink>
    </center>
    <main>
        <center>
            <font style="color: #00ff00">
                <p><?php
                    if (isset($_SESSION['message']) and !empty($_SESSION['message'])) :
                        echo $_SESSION['message'];
                    else :
                        header("location: login.php");
                    endif;
                    ?></p>
                <a href="../index.php" class="">GO TO INDEX</a>
            </font>
        </center>
    </main>
</body>

</html>