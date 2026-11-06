<?php
require_once __DIR__ . '/../src/database.php';
require_once __DIR__ . '/../src/expenses.php';

$pdo = getDBConnection();
$expenses = getAllExpenses($pdo);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Trackflow - Liste des dépenses</title>
</head>
<body>
    <h1>Liste des dépenses</h1>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($expenses)): ?>
                <tr>
                    <td colspan="5">Aucune dépense enregistrée pour le moment.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($expenses as $expense): ?>
                    <tr>
                        <td><?= htmlspecialchars($expense['id']) ?></td>
                        <!-- Correction du bug NULL pour PHP 8.1+ -->
                        <td><?= htmlspecialchars($expense['description'] ?? '') ?></td>
                        <td><?= htmlspecialchars($expense['amount']) ?> €</td>
                        <td><?= htmlspecialchars($expense['expense_date']) ?></td>
                        <td><?= htmlspecialchars($expense['category_name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>