<?php foreach ($items as $item): ?>
    <div class="product-card">
        <img src="https://via.placeholder.com/300x200" alt="<?= htmlspecialchars($item['name']) ?>">
        <div class="product-info">
            <h2><?= htmlspecialchars($item['name']) ?></h2>
            <p>Quantity: <?= htmlspecialchars($item['quantity']) ?></p>
            <p>Price: $<?= htmlspecialchars(number_format($item['price'], 2)) ?></p>
            <div class="actions">
                <a href="index.php?edit=<?= $item['id'] ?>">Edit</a>
                <a href="index.php?delete=<?= $item['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
