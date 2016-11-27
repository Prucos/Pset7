<?php

    // configuration
    require("../includes/config.php"); 

    // search for user shared in DB
    $rows = CS50::query( "SELECT * FROM history WHERE user_id = ?", $_SESSION["id"]);
    $positions = [];
    foreach ($rows as $row)
    {
        //if ($stock !== false)
        {
            $positions[] = [
                "transaction" => $row["transaction"],
                "price" => $row["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "timestamp" => $row["timestamp"]
            ];
        }
    }
    
    // render portfolio
    render("history_table.php", ["positions" => $positions, "title" => "History" ]);
?>