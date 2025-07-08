<?php
include 'db.php';
$amount = $_POST['amount'];
$conn->query("INSERT INTO income (amount) VALUES ($amount)");
header('Location: index.php');
