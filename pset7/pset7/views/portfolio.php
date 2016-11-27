<div class="panel panel-primary">
    <div class="panel-heading">Your stocks</div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Symbol</th>
                <th>Name</th>
                <th>Shares</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
        
                foreach ($positions as $position)
                {
                    print("<tr>");
                    print("<td>{$position["symbol"]}</td>");
                    print("<td>{$position["name"]}</td>");
                    print("<td>{$position["shares"]}</td>");
                    print("<td>\${$position["price"]}</td>");
                    print("</tr>");
                }
        
            ?>
            <tr  class="info">
                <td>FUNDS AVAILABLE:</td>
                <td></td>
                <td></td>
                <td>$<?= htmlspecialchars($cash) ?></td>
            </tr>
        </tbody>
    </table>
</div>