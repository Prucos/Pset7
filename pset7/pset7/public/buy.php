<?php
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("buy_form.php", ["title" => "Buy"]);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_SESSION["id"];
        $query = $_POST["query"];
        $amount = $_POST["amount"];
        $stock = lookup($query);
        $price = $amount * $stock["price"];
        
        // input checks
        if ( empty($query) || empty($amount) ) apologize("Query filed is empty!");
        if ($stock === false) apologize("Incorrect input");
        if( !preg_match("/^\d+$/", $amount) ) apologize("Incorrect amount of shares!");
        
        // check if user has enough funds
        $rows = CS50::query("SELECT cash FROM users WHERE id = ?", $id);
        $cash = $rows[0]["cash"];
        if ( $cash - $price < 0) apologize("Insufficient funds!");
        
        CS50::query("INSERT INTO portfolio (user_id, symbol, shares) VALUES( ?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $id, $query, $amount);
        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $price, $id);
        CS50::query("INSERT INTO history (transaction, timestamp, symbol, shares, price, user_id) VALUES( 'BUY', CURRENT_TIMESTAMP, ?, ?, ?, ?)", $query, $amount, $stock["price"], $id);
        
        apologize ("You've bought {$amount} of {$query} shares for {$price} ");
        
    };

?>