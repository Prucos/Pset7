<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // TODO
        // VALIDATION
        if( empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["confirmation"])  ) {
            apologize("please fill the required fields!");
        }
        
        if ( $_POST["password"] != $_POST["confirmation"] ) {
            apologize("passwords do not match");
        }
        
        // ADDING TO SQL
        $result = CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 1000.00)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
        if ($result === false) {
            apologize("username already exists");
        }
        
        // GET USER ID
        $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        $_SESSION["id"] = $id;
        redirect("/index.php");
        
    }

?>






