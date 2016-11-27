<?php
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("quote_form.php", ["title" => "Register"]);
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $query = $_POST["query"];
        $stock = lookup($query);
        
        if ( empty($stock) ) apologize("Query filed is empty!");
        if ($stock === false) apologize("Incorrect input");
        
        render("quote_result.php", ["query" => $stock["symbol"], "name" => $stock["name"], "price" => number_format($stock["price"], 4) ]);
    };
?>