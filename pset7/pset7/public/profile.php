<?php
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        render("profile_form.php", ["title" => "Profile"]);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_SESSION["id"];
        $oldPass = $_POST["oldPass"];
        $newPass = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
        $actualPass = CS50::query("SELECT hash FROM users WHERE id = ?",  $id);
        $actualPass = $actualPass[0]["hash"];
        
        // input checks
        if ( empty($oldPass) || empty($newPass) ) apologize("Please fill all required fields!");
        if (password_verify($oldPass, $actualPass)) {
            CS50::query("UPDATE users SET hash = ? WHERE id = ?", $newPass, $id);
             apologize("Your password has been changed");
        } else {
            apologize("Passwords don't match! Old pass = {$oldPass}, new = {$newPass}, act = {$actualPass}");
        };
             

        
    };

?>