<!--https://cs4640.cs.virginia.edu/jms2wyw/sprint2/index.html-->
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Index Page</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laura Segura, Jose Sanchez">
    <meta name="description" content="Laura worked on the css part and Jose worked on the html part">
    <meta name="keywords" content="define keywords for search engines">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .hover {
            cursor: pointer;
            text-decoration: underline;
            color: yellow;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    /*$(document).ready(function() {
        $("button").on("mouseover", function() {
            $(this).addClass("hover");
        });
        $("button").on("mouseout", function() {
            $(this).removeClass("hover");
        });*/
    </script>
</head>
<body>
    <div>
        <header>
            <h1>
                International Restaurants
            </h1>
            <h2 id="message"></h2>
            <nav class="navbar navbar-expand-lg navbar-inverse" aria-label="Main Navigation Bar">
                <div>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <form action="?command=index" method="post">
                            <button class="nav-link" type="submit">Home</button>
                        </form>
                        <form action="?command=login" method="post">
                            <button class="nav-link" type="submit">Login/Log Out</button>
                        </form>
                        <form action="?command=userList" method="post">
                            <button class="nav-link" type="submit">My Saved Restaurants</button>
                        </form>



                            <form id="searchForm"  action='/' onsubmit="searchRestaurant();" method="post">
                                <input type="search" placeholder="Search" id="form1" name="form1" class="form-control rounded" />
                                <button type="submit" class="btn btn-outline-primary" ></i>Search</button>
                            </form>

                        <h2>Welcome <?=$uname?>!</h2>
                    </ul>
                </div>
            </nav>
        </header>

    </div>
    <div>
            <div class="media col-12">
                <?php
                    foreach ($restaurantList as $restaurant){

                        echo "
                        <form action='?command=saveRestaurant' method='POST'>
                            <input type='hidden' id='restaurantName' name='restaurantName' value='".$restaurant['restaurant']."'>
                                <section>
                                    <div class='media col-12'>
                                        <h1>".$restaurant['restaurant']. "</h1?>
                                            <p>" .$restaurant['description']."<br>". $restaurant['hours']."<br>". $restaurant['address']."<br></p>
                                                <button type='submit' id='save' onclick='myFunction();'>Save Restaurant</button>
                                    </div>
                                </section>
                        </form>";
                    }
                ?>
            </div>
            <script>
                   var restaurant;
                   var l;
                ( () => {
                    document.getElementById("message").innerHTML = "Welcome to International Restaurants in Charlottesville!";
                } )();

                    function myFunction() {
                      alert("Saved!");
                    }

                    function myFunction1() {
                      alert("Saved!");
                    }




searchRestaurant();

                function searchRestaurant(form){

                    document.getElementById("searchForm").addEventListener("submit", (e) => {
                    e.preventDefault();
                    let search = document.getElementById("form1");
                    var ajax = new XMLHttpRequest();
                    ajax.open("GET", "?command=getRestaurantsJSON", true);
                    ajax.responseType = "json";
                    ajax.send(null);
                    ajax.addEventListener("load", function() {
                      if (this.status == 200) {
                          restaurants = this.response;
                          console.log(restaurants);
                          for (const restaurant of restaurants){
                            if (restaurant["restaurant"].toLowerCase() == search.value.toLowerCase()){
                                l = restaurant;
                                console.log(l);
                                console.log(JSON.stringify(l));
                                search.value = JSON.stringify(l);

                                document.getElementById("searchForm").action = "?command=showSearched";
                                document.getElementById("searchForm").submit();
                                }
                              }
                          }
                      });
                    });
                }
             </script>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>