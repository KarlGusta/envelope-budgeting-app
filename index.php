<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Envelope Budgeting App</title>
</head>
<body>
    <h1>Envelope Budgeting App</h1>

    <!-- Total Income -->
    <h2>Total Income:</h2>
    <?php
    $res = $conn->query("SELECT SUM(amount) as total FROM income");
    $totalIncome = $res->fetch_assoc()['total'] ?? 0;

    $res2 = $conn->query("SELECT SUM(balance) as used FROM envelopes");
    $used = $res2->fetch_assoc()['used'] ?? 0;

    $available = $totalIncome - $used;
    echo "<p>Available: $$available</p>";
    ?>

    <!-- Add Income -->
    <h3>Add Income</h3>
    <form action="add_income.php" method="post">
        <input type="number" step="0.01" name="amount" required>
        <button type="submit">Add</button>
    </form>

    <!-- View Envelopes -->
    <h3>Envelopes</h3>
    <ul>
        <?php
        $envs = $conn->query("SELECT * FROM envelopes");
        while ($row = $envs->fetch_assoc()) {
            echo "<li><strong>{$row['name']}</strong>: \${$row['balance']}</li>";
        }
        ?>
    </ul>

    <!-- Allocate to Envelope -->
    <h3>Allocate Income to Envelope</h3>
    <form action="allocate.php" method="post">
        <select name="envelope_id">
            <?php
            $envs = $conn->query("SELECT * FROM envelopes");
            while ($row = $envs->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select>
        <input type="number" step="0.01" name="amount" required>
        <button type="submit">Allocate</button>
    </form>

    <!-- Spend from Envelope -->
    <h3>Spend from Envelope</h3>
    <form action="spend.php" method="post">
        <select name="envelope_id">
            <?php
            $envs = $conn->query("SELECT * FROM envelopes");
            while ($row = $envs->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select>
        <input type="number" step="0.01" name="amount" required>
        <button type="submit">Spend</button>
    </form>
</body>
</html>
