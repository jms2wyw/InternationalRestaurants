<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In Page</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Your Name">
    <meta name="description" content="Description of this page">
    <meta name="keywords" content="keywords for search engines">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>

        section {
            max-width: 400px;
            margin: 0 auto;
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 2px solid #ccc;
            border-radius: 3px;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: black;
            color: white;
            border-radius: 3px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: grey;
        }
        .or-divider {
            margin: 20px 0;
            font-weight: bold;
        }
        button[type="signup"] {
            padding: 10px 20px;
            background-color: dodgerblue;
            color: white;
            border-radius: 3px;
            cursor: pointer;
        }
        button[type="signup"]:hover {
            background-color: lightblue;
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



            </ul>
        </div>
    </nav>
</header>
<div>
    <section>
        <h1>Log In</h1>
        <form action="?command=loggedIn" method="post">
        <div>
            <label for="uname">Username</label>
            <input type="text" placeholder="Enter Username" id="uname" name="uname"required>
        </div>
        <div>
            <label for="psw">Password</label>
            <input type="password" placeholder="Enter Password" id="psw" name="psw" required>
        </div>
        <div>
            <button type="submit">Next</button>
        </div>
        </form>
        <div class="or-divider">or</div>
        <div>
            <form action="?command=signup" method="post">
                <button type="submit">Create Account</button>
            </form>
        </div>

    </section>
</div>
</body>
</html>
