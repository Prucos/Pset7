<?php
    
    // configuration
        require("../includes/config.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        
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
        render("sell_form.php", ["positions" => $positions, "title" => "Sell", "cash" => number_format($cash[0]["cash"], 4, ".", " ") ]);
        
        // processing user input
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        if ( empty($_POST["stockToSell"]) ) {
                apologize("You must choose a stock to sell!");
        }
        
        // calculating user income from sold shares
        $soldSymbol = $_POST["stockToSell"];
        $rows = CS50::query( "SELECT shares FROM portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $soldSymbol);
        $stock = lookup($soldSymbol);
        $income = $stock["price"] * $rows[0]["shares"];
        
        // updating tables
        CS50::query("DELETE FROM portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $soldSymbol );
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $income, $_SESSION["id"] );
        CS50::query("INSERT INTO history (transaction, timestamp, symbol, shares, price, user_id) VALUES( 'SELL', CURRENT_TIMESTAMP, ?, ?, ?, ?)", $soldSymbol, $rows[0]["shares"], $stock["price"] , $_SESSION["id"]);

        
        apologize("{$soldSymbol} has been sold for {$income} USD. Check your account");
        
    }
?>




