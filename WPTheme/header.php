<html>
    <head>
        <title>David Gaming</title>
        <link rel="shortcut icon" href="/Logo.ico" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <script
                src="https://code.jquery.com/jquery-3.1.1.min.js"
                integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
                crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-h21C2fcDk/eFsW9sC9h0dhokq5pDinLNklTKoxIZRUn3+hvmgQSffLLQ4G4l2eEr" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container-fluid navbar-inverse">
            <div class="row">
                <div class="col-sm-1">
                    <img src="http://cdn.akamai.steamstatic.com/steamcommunity/public/images/avatars/f6/f6ad585742d5c31af4a2ae249864e6d88390559c_full.jpg" height="70" width="70">
                </div>
                <div class="col-sm-10" style="color: white">
                    <h1 style="text-align: center">David Gaming</h1>
                </div>
                <div class="col-sm-1">
                    <span id="time" style="color: white"></span>
                    <br>
                    <span id="date" style="color: white"></span>
                </div>
                <script>
                    var d = new Date();
                    var month = d.getMonth()+1;
                    var day = d.getDate();
                    var year = d.getFullYear();
                    var date = day + "/" + month + "/" +year;
                    document.getElementById("date").innerHTML = date;
                    var d = new Date();
                    var hour = d.getHours();
                    var minutes = d.getMinutes();
                    if(minutes<10) minutes = "0" + minutes;
                    var time = hour + ":" + minutes;
                    document.getElementById("time").innerHTML = time;
                </script>
            </div>
            <div class="row">
                <?php
                $ID = getMenuIdFromLocation('main-menu');
                $menu = getMenuStructureObjectById($ID);
                $menuItems = structureMenuItems($menu);
                ?>
                <div class="col-sm-8 btn-group" style="text-align: left;">
                    <?php
                        foreach ($menuItems as $menuItem) {
                            if ($menuItem['children'] == null) {
                                echo '<a href="'.$menuItem['url'].'" class="btn btn-default">'.$menuItem['title'].'</a>';
                            }
                            if ($menuItem['children']) {
                                echo '<a href="'.$menuItem['url'].'" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'.$menuItem['title'].'</a>';
                                echo '<ul class="dropdown-menu">';
                                foreach ($menuItem['children'] as $child) {
                                    echo '<li><a href="'.$child['url'].'">'.$child['title'].'</a></li>';
                                }
                                echo '</ul>';
                            }
                        }
                    ?>
                </div>
                <?php
                $ID = getMenuIdFromLocation('top_right');
                $menu = getMenuStructureObjectById($ID);
                $menuItems = structureMenuItems($menu);
                ?>
                <div class="col-sm-4" style="text-align: right">
                    <?php
                        foreach ($menuItems as $menuItem) {
                            if ($menuItem['children'] == null) {
                                echo '<a href="'.$menuItem['url'].'" class="btn btn-default">'.$menuItem['title'].'</a>';
                            }
                            if ($menuItem['children']) {
                                echo '<div class="btn-group">';
                                    echo '<a href="'.$menuItem['url'].'" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'.$menuItem['title'].'<span class="caret"></span></a>';
                                    echo '<ul class="dropdown-menu">';
                                    foreach ($menuItem['children'] as $child) {
                                        echo '<li><a href="'.$child['url'].'">'.$child['title'].'</a></li>';
                                    }
                                    echo '</ul>';
                                echo '</div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="container">