<?php
include 'db.php'; // Ensure this path is correct
include 'functions.php'; // Ensure this path is correct

// Handle form submissions
handleFormSubmission($pdo);

// Read items from the database
$items = getItems($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <style>
        /* Add your CSS styles here (same as previous example) */
    </style>
</head>
<body>
    <div class="container">
        <h1>Inventory Management</h1>

        <div class="form-container">
            <form method="post">
                <h2>Add New Item</h2>
                <input type="text" name="name" placeholder="Item Name" required>
                <input type="number" name="quantity" placeholder="Quantity" required>
                <input type="number" step="0.01" name="price" placeholder="Price" required>
                <button type="submit" name="add">Add Item</button>
            </form>
        </div>

        <div class="table-container">
            <h2>Inventory List</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']) ?></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td><?= htmlspecialchars($item['price']) ?></td>
                        <td class="actions">
                            <a href="index.php?edit=<?= $item['id'] ?>">Edit</a>
                            <a href="index.php?delete=<?= $item['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <?php if (isset($_GET['edit'])):
            $id = $_GET['edit'];
            $item = getItemById($pdo, $id);
        ?>
            <div class="edit-form">
                <h2>Edit Item</h2>
                <form method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                    <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" required>
                    <input type="number" name="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" required>
                    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($item['price']) ?>" required>
                    <button type="submit" name="update">Update Item</button>
                </form>
            </div>
        <?php endif; ?>

        <h2>Products</h2>
        <div class="products">
            <?php include 'item_display.php'; ?>
        </div>
    </div>
</body>
</html>
