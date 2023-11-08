<?php

class RestaurantController {
    private $restaurant = [];
    private $input = [];
    public $savedRestaurants = [];

    public function __construct($input) {
        session_start();
        $this->input = $input;
        $this->savedRestaurants;
        $this->loadRestaurants();
    }

    public function loadRestaurants() {
        $this->restaurant = json_decode(
            file_get_contents("restaurants.json"), true);

        if (empty($this->restaurant)) {
                    die("Something went wrong loading restaurants");
                }
    }
    public function getRestaurants($id=null) {
                    $restaurantList = $this->restaurant;
                    return $restaurantList;


        }





    public function run() {
            // Get the command
            $command = "index";
            if (isset($this->input["command"]))
                $command = $this->input["command"];

            switch($command) {


                case "signup":
                    $this->showsignUp();
                    break;
                case "userList":
                    $this->showUserList();
                    break;
                case "login":
                    $this->showLogin();
                    break;
                case "loggedIn":
                    $this->login();
                case "signedup":
                    $this->signup();
                case "saveRestaurant":
                    $this->saveRestaurant();
                case "unsave":
                    $this->unsaveRestaurant();
                default:
                    $this->showIndex();
                    break;
            }
        }

    public function saveRestaurant(){
        foreach ($this->getRestaurants() as $restaurant){
            if ($restaurant["restaurant"] === $_POST["restaurantName"]&& !in_array($restaurant,$_SESSION["savedRestaurants"])){
                array_push($_SESSION["savedRestaurants"], $restaurant);
            }
        }

    }
    public function unsaveRestaurant(){
        echo $_SESSION["savedRestaurants"];
        $savedRestaurants = $_SESSION["savedRestaurants"];
        foreach ($savedRestaurants as $restaurant){
                    if ($restaurant["restaurant"] === $_POST["restaurantName"]){
                        unset($savedRestaurants[0]);
                    }
                }
        $_SESSION["savedRestaurants"] = $savedRestaurants;
    }

    public function showIndex() {
        $message = "";
        if (!empty($this->errorMessage))
            $message .= "<p class='alert alert-danger'>".$this->errorMessage."</p>";
        $restaurantList = $this->getRestaurants();
        $uname = $_SESSION["name"];
        $email = $_SESSION["email"];

        include("index.php");
    }

    public function showLogin() {
        include("login.php");

    }

    public function showsignUp() {
        include("signup.html");
    }

    public function showUserList() {
        $uname = $_SESSION["name"];
        $email = $_SESSION["email"];
        $savedRestaurants = $_SESSION["savedRestaurants"];
        include("myRestaurantList.php");

    }
    public function login() {
        if(isset($_POST["uname"])) {
            $_SESSION["name"] = $_POST["uname"];
        }


    }
    public function signup() {

        if(isset($_POST["uname"])) {
            $_SESSION["name"] = $_POST["uname"];
        }

        if(isset($_POST["email"])) {
            $_SESSION["email"] = $_POST["email"];
        }

    }
}