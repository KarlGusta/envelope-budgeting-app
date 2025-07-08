<?php
include 'db.php';

$envelope_id = $_POST['envelope_id'];
$amount = $_POST['amount'];

$conn->query("UPDATE envelopes SET balance = balance + $amount WHERE id = $envelope_id");
header('Location: index.php');
