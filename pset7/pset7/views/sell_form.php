<form action="sell.php" method="post">
    <select size="1" name="stockToSell" class="form-control">
        <?php foreach ($positions as $position)
                    {
                        echo("<option value=\"{$position["symbol"]}\"> {$position["symbol"]} | Amount: {$position["shares"]} | Price: \$ {$position["price"]} </option> ");
                    }
        ?>
       </select>
       <input type="submit" value="Sell" class="btn btn-primary">
</form>