<div class="panel panel-primary">
    <div class="panel-heading">History</div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Transaction</th>
                <th>Date/Time</th>
                <th>Symbol</th>
                <th>Shares</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
        
                foreach ($positions as $position)
                {
                    print("<tr>");
                    print("<td>{$position["transaction"]}</td>");
                    print("<td>{$position["timestamp"]}</td>");
                    print("<td>{$position["symbol"]}</td>");
                    print("<td>\${$position["shares"]}</td>");
                    print("<td>\${$position["price"]}</td>");
                    print("</tr>");
                }
        
            ?>
        </tbody>
    </table>
</div>
