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
</head>
<body>
    <div>
        <header>
            <h1>
                International Restaurants
            </h1>
            <nav class="navbar navbar-expand-lg navbar-inverse" aria-label="Main Navigation Bar">
                <div>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <form action="?command=index" method="post">
                            <button class="nav-link" type="submit">Home</button>
                        </form>
                        <form action="?command=login" method="post">
                            <button class="nav-link" type="submit">Login/Sign Up</button>
                        </form>
                        <form action="?command=userList" method="post">
                            <button class="nav-link" type="submit">My Saved Restaurants</button>
                        </form>


                        <div class="input-group">

                                <input type="search" placeholder="Search" id="form1" class="form-control rounded" />


                            <button type="button" class="btn btn-outline-primary" >
                                <span  id="search-addon">
                                <i class="fas fa-search"></i>Search
                                    </span>
                            </button>
                        </div>
                        <h2>Welcome <?=$uname?>! (<?=$email?>)</h2>
                    </ul>
                </div>
            </nav>
        </header>

    </div>
    <div>
            <div class="media col-12">
                <?php

                    foreach ($restaurantList as $restaurant){
                        echo "<form action='?command=saveRestaurant' method='POST'>
                        <input type='hidden' name='restaurantName' value='".$restaurant['restaurant']."'>
                        <section>
                        <div class='media col-12'>
                        <h1>".$restaurant['restaurant']. "</h1?>
                        <p>" .$restaurant['description']."<br>". $restaurant['hours']."<br>". $restaurant['Address']."<br>

                        </p>
                        <button type='submit' >Save Restaurant</button>
                        </div>
                        </section>
                        </form>";
                    }
                ?>
            </div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>