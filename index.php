<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <title>effectif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/login.css">
    <body>
        <?php
        if(isset($_SESSION['username'])){
            echo '
        <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="width:10%;" id="mySidebar">
            <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
            <a href="#" class="w3-bar-item w3-button">Link 1</a>
            <a href="#" class="w3-bar-item w3-button">Link 2</a>
            <a href="#" class="w3-bar-item w3-button">Link 3</a>
        </div>
            ';
        }
        ?>

        <div id="main" class="w3-main" style="margin-left:10%">
        </div>

        <script src="js/general.js"></script>
        <script src="js/routing.js"></script>
        <script src="js/navigation.js"></script>
        
    </body>
</html>