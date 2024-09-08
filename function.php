<?php

function handleFormSubmission($pdo) {
    // Create
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $stmt = $pdo->prepare("INSERT INTO items (name, quantity, price) VALUES (?, ?, ?)");
        $stmt->execute([$name, $quantity, $price]);
    }

    // Update
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $stmt = $pdo->prepare("UPDATE items SET name = ?, quantity = ?, price = ? WHERE id = ?");
        $stmt->execute([$name, $quantity, $price, $id]);
    }

    // Delete
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
        $stmt->execute([$id]);
    }
}

function getItems($pdo) {
    $stmt = $pdo->query("SELECT * FROM items");
    return $stmt->fetchAll();
}

function getItemById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}
?>
