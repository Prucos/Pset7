<?php

    // configuration
    require("../includes/config.php"); 

    // search for user shared in DB
    $rows = CS50::query( "SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
    $cash = CS50::query( "SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        //if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
            ];
        }
    }
    
    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "cash" => number_format($cash[0]["cash"], 4, ".", " ") ]);
?>
