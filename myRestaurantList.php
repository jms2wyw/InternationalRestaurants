<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Page</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Your Name">
    <meta name="description" content="Description of this page">
    <meta name="keywords" content="keywords for search engines">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            margin: 20px 0;
            font-size: 20px;
        }
        p {
            margin-bottom: 20px;
        }
        .btn {
            margin-top: 10px;
        }
        .input-group {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<header>
    <h1>International Restaurants</h1>
    <nav class="navbar navbar-expand-lg navbar-inverse" aria-label="Main Navigation Bar">
        <div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <form action="?command=index" method="post">
                    <button class="nav-link" type="submit">Home</button>
                </form>
                <form action="?command=login" method="post">
                    <button class="nav-link" type="submit">Login/Log out</button>
                </form>
                <form action="?command=userList" method="post">
                    <button class="nav-link" type="submit">My Saved Restaurants</button>
                </form>
            </ul>
            <div class="input-group">
                <input type="search" placeholder="Search" id="form1" class="form-control rounded" />
                <button type="button" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
            <h2>Welcome <?=$uname?>! (<?=$email?>)</h2>
        </div>
    </nav>
</header>
<div class="media col-12">
                <?php

                    foreach ($savedRestaurants as $restaurant){


                        echo "<form name='deleteForm' action='/' onsubmit='return myFunction(this)' method='post'><section>
                        <input type='hidden' id='restaurantName' name='restaurantName' value='".$restaurant['restaurant']."'>
                         <div class='media col-12'>
                         <h1>".$restaurant["restaurant"]."<br>
                         <p>" .$restaurant['description']."<br>". $restaurant['hours']."<br>". $restaurant['address']."<br>
                        </p>

                        <button id='deleteBtn' name='deleteBtn' type='submit' >Delete Restaurant</button>
                        </div>
                         </section>
                         </form>";
                    }
                ?>
            </div>
            <script>

                    function myFunction(form) {
                        if(confirm("Are you sure you want to delete?")){
                            form.action = "?command=unsaveRestaurant";
                        }else{
                            form.action = "?command=userList";
                        }

                    }
                </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
