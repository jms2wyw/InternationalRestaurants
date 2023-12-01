<?php

class RestaurantController {
    private $restaurant = [];
    private $input = [];
    private $savedRestaurants = [];
    private $db;
    private $errorMessage = "";
    private $r = "";
    private $a = "";


    public function __construct($input) {
        session_start();
        $this->db = new Database();
        $this->input = $input;

    }

    public function loadRestaurants() {
        $this->restaurant = json_decode(
            file_get_contents("restaurants.json"), true);

        if (empty($this->restaurant)) {
                    die("Something went wrong loading restaurants");
                }
    }
    public function getRestaurants($id=null) {
        $res = $this->db->query("Select * from restaurants;");
                    $restaurantList = $this->restaurant;
            return $res;


        }
    public function getRestaurantsJSON() {
            $res = $this->db->query("Select * from restaurants;");
            //$oneRes = $res[0];
            header("Content-type: application/json");
            echo json_encode($res, JSON_PRETTY_PRINT);


            }






    public function run() {
            // Get the command
            $this->initializeData();
            $command = "index";
            if (isset($this->input["command"]))
                $command = $this->input["command"];

            switch($command) {
                case "getRestaurantsJSON":
                    $this->getRestaurantsJSON();
                    break;
                case "showSearched":
                    $this->showSearched();
                    break;
                case "login":
                    $this->showLogin();
                    break;
                case "logout":
                    $this->logout();
                    break;
                case "signup":
                    $this->showsignUp();
                    break;
                case "unsaveRestaurant":
                    $this->unsaveRestaurant();
                case "userList":
                    $this->showUserList();
                    break;



                case "loggedIn":
                    $this->login();
                    break;
                case "signedup":
                    $this->signup();
                    break;

                case "saveRestaurant":
                    $this->saveRestaurant();


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
        $this->r = serialize($_SESSION["savedRestaurants"]);

        //echo $this->r;
        $this->a = unserialize($this->r);


        ///echo $this->to_pg_array1($this->to_pg_array($_SESSION["savedRestaurants"]));
        $this->db->query("update users set restaurantlist = $1 where email = $2;", $this->r, $_SESSION["email"]);

    }



    public function unsaveRestaurant(){

        $savedRestaurants = $_SESSION["savedRestaurants"];

        for ($x = 0; $x <= sizeof($savedRestaurants); $x++){
            if ($savedRestaurants[$x]["restaurant"] === $_POST["restaurantName"]){
                unset($savedRestaurants[$x]);
                $_SESSION["savedRestaurants"] = [];

        }

        }
        foreach ($savedRestaurants as $restaurant){
            array_push($_SESSION["savedRestaurants"], $restaurant);
        }
        $this->r = serialize($_SESSION["savedRestaurants"]);
        $this->db->query("update users set restaurantlist = $1 where email = $2;", $this->r, $_SESSION["email"]);

    }

    public function showIndex($e=null) {
        $message = "";
        if (!empty($this->errorMessage))
            $message .= "<p class='alert alert-danger'>".$this->errorMessage."</p>";
        $restaurantList = $this->getRestaurants();
        $uname = $_SESSION["name"];
        $email = $_SESSION["email"];

        include("index.php");
    }

    public function showSearched(){
        $some = json_decode($_POST["form1"]);
        $restaurantList = [json_decode(json_encode($some), true)];
        $uname = $_SESSION["name"];
        $email = $_SESSION["email"];
        include("index.php");

    }

    public function showLogin() {
        $message = "";
        if (!empty($this->errorMessage))
            $message .= "<p class='alert alert-danger'>".$this->errorMessage."</p>";
        include("login.php");

    }

    public function showsignUp() {
        $message = "";
        if (!empty($this->errorMessage))
            $message .= "<p class='alert alert-danger'>".$this->errorMessage."</p>";
        include("signup.html");
    }

    public function showUserList() {
        $uname = $_SESSION["name"];
        $email = $_SESSION["email"];
        $phpArray = '';

        $savedRestaurants = $_SESSION["savedRestaurants"];
        include("myRestaurantList.php");

    }
    public function login() {
        if(isset($_POST["uname"]) && !empty($_POST["uname"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["psw"]) && !empty($_POST["psw"])){
            $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
            if (empty($res)){
                $this->errorMessage = "Incorrect email, Create an account if you do not have one";
            }
            else{
                 if (password_verify($_POST["psw"], $res[0]["password"])) {
                                        // Password was correct
                    $_SESSION["name"] = $res[0]["name"];
                    $_SESSION["email"] = $res[0]["email"];
                    $_SESSION["savedRestaurants"] = unserialize($res[0]["restaurantlist"]);
                    header("Location: ?command=index");
                    return;
                } else {
                    $this->errorMessage = "Incorrect password.";
                }
            }

                    }
            $this->showLogin();



    }

    public function logout() {
        session_destroy();
        header("Location: ?command=index");
        return;
    }
    public function signup() {
       echo isset($_POST["uname"]);
       if(isset($_POST["uname"]) && !empty($_POST["uname"]) &&
           isset($_POST["email"]) && !empty($_POST["email"]) &&
           isset($_POST["psw"]) && !empty($_POST["psw"])){
            $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
            if (empty($res)) {
                $this->db->query("insert into users (name, email, password, restaurantlist) values ($1, $2, $3, $4);",
                    $_POST["uname"], $_POST["email"],
                    password_hash($_POST["psw"], PASSWORD_DEFAULT), '');
                $_SESSION["name"] = $_POST["uname"];
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["restaurantList"] = [];

                // Send user to the appropriate page (question)
                header("Location: ?command=index");
                return;

            }else {
                $this->errorMessage = "You already have an account.";
            }
            $this->showsignUp();

           }

        if(isset($_POST["uname"])) {
            $_SESSION["name"] = $_POST["uname"];
        }

        if(isset($_POST["email"])) {
            $_SESSION["email"] = $_POST["email"];
        }

    }
    public function initializeData() {
        if(!isset($_SESSION["initialized"])) {

            $_SESSION["initialized"] = true;
            $_SESSION["name"] = "";
            $_SESSION["email"] = "";
            $_SESSION["savedRestaurants"] = [];

        }
    }
}