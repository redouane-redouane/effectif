<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>electag</title>

    <!-- w3.css import -->
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/filtersearch.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/login.css">

    <!--Leaflet import-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" 
        integrity="sha512-gc3xjCmIy673V6MyOAZhIW93xhM9ei1I+gLbmFjUHIjocENRsLX/QUE1htk5q1XV2D/iie/VQ8DXI6Vu8bexvQ==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js" 
        integrity="sha512-ozq8xQKq6urvuU6jNgkfqAmT7jKN2XumbrX1JiB3TnF7tI48DPI4Gy1GXKD/V3EExgAs1V+pRO7vwtS1LHg0Gw==" 
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <script src="js/ui_effects.js"></script>
    <script src="js/global.js"></script>
    <script src="js/map.js"></script>
    <script src="js/zone.js"></script>
    <script src="js/table.js"></script>
    <script src="js/electag.js"></script>
    <script src="js/config.js"></script>
    <script src="js/admin.js"></script>
</head>
<body>
    <?php
    if(isset($_SESSION['username'])){
        echo '
        <div class="w3-black">
            <button class="w3-button w3-black" onclick="w3_open()">☰   '.$_SESSION["username"].'</button>
        </div>
        <div class="w3-sidebar w3-bar-block w3-border-right w3-black" style="display:none; z-index: 5000000;" id="mySidebar">
            <button id="menu_close" onclick="w3_close()" class="w3-button w3-bar-item w3-large w3-black">Close &times;</button>
            <div id="trackerDropdown" class="w3-dropdown-click">
                <button id="menu_select_tracker" id="select_tracker_btn" class="w3-button" onclick="trackers_menu()">
                    Select tracker
                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M1 1L5 5L9 1" stroke="#fff" data-v-4704f900=""></path>
                    </svg>
                </button>
                <div id="trackers_menu" class="w3-dropdown-content w3-bar-block">
		            <input id="menu_input" class="w3-bar-item" type="text" placeholder="Search.." id="trackerSearch" onkeyup="filterSearch(\'trackerSearch\',\'trackerDropdown\',\'a\');">
	                <script>
			            load_trackers();
		            </script>
                </div>
            </div>
            <div class="w3-dropdown-click">
                <button id="menu_time_range" class="w3-button" onclick="time_range()">
                    Time Range
                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M1 1L5 5L9 1" stroke="#fff" data-v-4704f900=""></path>
                    </svg>
                </button>
                <div id="time_range" class="w3-dropdown-content w3-bar-block">
                    <a id="menu_last_hour" class="w3-bar-item w3-button">Last hour</a>
                    <a id="menu_last_day" class="w3-bar-item w3-button">Last day</a>
                    <a id="menu_last_week" class="w3-bar-item w3-button">Last week</a>
                    <a id="menu_all_positions" class="w3-bar-item w3-button">All positions</a>
                </div>
            </div>
            <div class="w3-dropdown-click">
                <button id="menu_refresh_rate" class="w3-button" onclick="refresh_rate()">
                    Refresh rate
                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M1 1L5 5L9 1" stroke="#fff" data-v-4704f900=""></path>
                    </svg>
                </button>
                <div id="refresh_rate" class="w3-dropdown-content w3-bar-block">
                    <a id="menu_10_s" class="w3-bar-item w3-button">10 seconds</a>
                    <a id="menu_20_s" class="w3-bar-item w3-button">20 seconds</a>
                    <a id="menu_1_m" class="w3-bar-item w3-button">1 minute</a>
                    <a id="menu_5_m" class="w3-bar-item w3-button">5 minutes</a>
                </div>
            </div>

            <div class="w3-dropdown-click">
                <button id="menu_language" class="w3-button" onclick="show_language()">
                    Language
                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M1 1L5 5L9 1" stroke="#fff" data-v-4704f900=""></path>
                    </svg>
                </button>
                <div id="language" class="w3-dropdown-content w3-bar-block">
                    <a class="w3-bar-item w3-button" onclick="switch_to_arabic()">العربية</a>
                    <a class="w3-bar-item w3-button" onclick="switch_to_english()">English</a>
                    <a class="w3-bar-item w3-button" onclick="switch_to_french()">Français</a>
                </div>
            </div>

            <a id="menu_map" href="#map" class="w3-bar-item w3-button">Map</a>
            <a id="menu_table" href="#table" class="w3-bar-item w3-button">Table</a>
            <a id="menu_config" href="#config" class="w3-bar-item w3-button">Config</a>
            <a id="menu_admin" href="#admin" class="w3-bar-item w3-button">Admin</a>
            <a id="menu_logs" href="#logs" class="w3-bar-item w3-button">Logs</a>

            <a id="menu_logout" href="db/logout.php" class="w3-bar-item w3-button">Logout</a>
        </div>
        ';
    }
    ?>
    
    <div id="main">
        
    </div>
    <script src="js/routing.js"></script>
    <script>
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
        }

        function trackers_menu() {
            var x = document.getElementById("trackers_menu");
            if (x.className.indexOf("w3-show") == -1) { 
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        function time_range() {
            var x = document.getElementById("time_range");
            if (x.className.indexOf("w3-show") == -1) { 
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        function refresh_rate() {
            var x = document.getElementById("refresh_rate");
            if (x.className.indexOf("w3-show") == -1) { 
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        function show_language() {
            var x = document.getElementById("language");
            if (x.className.indexOf("w3-show") == -1) { 
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        function switch_to_french(){
            language = "fr";
            document.getElementById("menu_select_tracker").innerHTML = "Sélectionner bracelet \
                    <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                        <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
                    </svg>";
            
            document.getElementById("menu_input").placeholder = "Rechercher..";

            document.getElementById("menu_time_range").innerHTML = "Interval de temps \
                    <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                        <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
                    </svg>";
            
            document.getElementById("menu_last_hour").innerHTML = "Dernière heure";
            document.getElementById("menu_last_day").innerHTML = "Dernier jour";
            document.getElementById("menu_last_week").innerHTML = "Dernière semaine";
            document.getElementById("menu_all_positions").innerHTML = "Toutes les positions";

            document.getElementById("menu_refresh_rate").innerHTML = "Taux d'actualisation \
            <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
            </svg>";

            document.getElementById("menu_10_s").innerHTML = "10 secondes";
            document.getElementById("menu_20_s").innerHTML = "20 secondes";
            document.getElementById("menu_1_m").innerHTML = "1 minute";
            document.getElementById("menu_5_m").innerHTML = "5 minutes";

            document.getElementById("menu_language").innerHTML = "Langue \
            <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
            </svg>";
            document.getElementById("menu_map").innerHTML = "Carte";
            document.getElementById("menu_table").innerHTML = "Tableau";
            document.getElementById("menu_config").innerHTML = "Configuration";
            document.getElementById("menu_admin").innerHTML = "Administration";
            document.getElementById("menu_logs").innerHTML = "Journal des évènements";
            document.getElementById("menu_logout").innerHTML = "Se déconnecter";
            document.getElementById("menu_close").innerHTML = "Fermer &times;";
        }

        function switch_to_english(){
            language = "en";
            document.getElementById("menu_select_tracker").innerHTML = "Select tracker \
                    <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                        <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
                    </svg>";
            
            document.getElementById("menu_input").placeholder = "Search..";

            document.getElementById("menu_time_range").innerHTML = "Time range \
                    <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                        <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
                    </svg>";
            
            document.getElementById("menu_last_hour").innerHTML = "Last hour";
            document.getElementById("menu_last_day").innerHTML = "Last day";
            document.getElementById("menu_last_week").innerHTML = "Last week";
            document.getElementById("menu_all_positions").innerHTML = "All positions";

            document.getElementById("menu_refresh_rate").innerHTML = "Refresh rate \
            <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
            </svg>";

            document.getElementById("menu_10_s").innerHTML = "10 seconds";
            document.getElementById("menu_20_s").innerHTML = "20 seconds";
            document.getElementById("menu_1_m").innerHTML = "1 minute";
            document.getElementById("menu_5_m").innerHTML = "5 minutes";

            document.getElementById("menu_language").innerHTML = "Language \
            <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
            </svg>";
            document.getElementById("menu_map").innerHTML = "Map";
            document.getElementById("menu_table").innerHTML = "Table";
            document.getElementById("menu_config").innerHTML = "Configuration";
            document.getElementById("menu_admin").innerHTML = "Administration";
            document.getElementById("menu_logs").innerHTML = "Events log";
            document.getElementById("menu_logout").innerHTML = "Logout";
            document.getElementById("menu_close").innerHTML = "Close &times;";
        }

        function switch_to_arabic(){
            language = "ar";
            document.getElementById("menu_select_tracker").innerHTML = "إختيار السوار \
                    <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                        <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
                    </svg>";
            
            document.getElementById("menu_input").placeholder = "..بحث";

            document.getElementById("menu_time_range").innerHTML = "المدة الزمنية \
                    <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                        <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
                    </svg>";
            
            document.getElementById("menu_last_hour").innerHTML = "آخر ساعة";
            document.getElementById("menu_last_day").innerHTML = "آخر يوم";
            document.getElementById("menu_last_week").innerHTML = "آخر أسبوع";
            document.getElementById("menu_all_positions").innerHTML = "كل الوضعيات";

            document.getElementById("menu_refresh_rate").innerHTML = "معدل التحديث \
            <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
            </svg>";

            document.getElementById("menu_10_s").innerHTML = "عشرة ثواني";
            document.getElementById("menu_20_s").innerHTML = "عشرون ثانية";
            document.getElementById("menu_1_m").innerHTML = "دقيقة";
            document.getElementById("menu_5_m").innerHTML = "خمس دقائق";

            document.getElementById("menu_language").innerHTML = "اللغة \
            <svg width='10' height='6' viewBox='0 0 10 6' fill='none'> \
                <path d='M1 1L5 5L9 1' stroke='#fff' data-v-4704f900=''></path> \
            </svg>";
            document.getElementById("menu_map").innerHTML = "الخريطة";
            document.getElementById("menu_table").innerHTML = "الجدول";
            document.getElementById("menu_config").innerHTML = "التعديلات";
            document.getElementById("menu_admin").innerHTML = "التسيير";
            document.getElementById("menu_logs").innerHTML = "اﻷحداث";
            document.getElementById("menu_logout").innerHTML = "خروج";
            document.getElementById("menu_close").innerHTML = "غلق &times;";
        }
    </script>
</body>
</html>
