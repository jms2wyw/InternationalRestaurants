<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

spl_autoload_register(function ($classname) {
    include "$classname.php";
});

$restaurant = new RestaurantController($_GET);

$restaurant->run();