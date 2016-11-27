<?php if (isset($query)): ?>
    <p>Symbol: <?= htmlspecialchars($query) ?></p>
<?php else: ?>
    <p>No symbol</title>
<?php endif ?>

<?php if (isset($name)): ?>
    <p>Name: <?= htmlspecialchars($name) ?></p>
<?php else: ?>
    <p>No name</p>
<?php endif ?>

<?php if (isset($price)): ?>
    <p>Price: <?= htmlspecialchars($price) ?></p>
<?php else: ?>
    <p>No price</p>
<?php endif ?>