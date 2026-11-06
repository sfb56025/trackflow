<?php

/**
 * Récupère toutes les dépenses (INNER JOIN + tri déterministe)
 */
function getAllExpenses(PDO $pdo): array {
    $stmt = $pdo->query("
        SELECT e.id, e.description, e.amount, e.expense_date, c.name AS category_name 
        FROM expenses e 
        INNER JOIN categories c ON e.category_id = c.id 
        ORDER BY e.expense_date DESC, e.id DESC
    ");
    return $stmt->fetchAll();
}

/**
 * Récupère une dépense par son ID via une requête préparée
 */
function getExpenseById(PDO $pdo, int $id): ?array {
    $stmt = $pdo->prepare("
        SELECT e.id, e.description, e.amount, e.expense_date, c.name AS category_name 
        FROM expenses e 
        INNER JOIN categories c ON e.category_id = c.id 
        WHERE e.id = :id
    ");
    $stmt->execute(['id' => $id]);
    $expense = $stmt->fetch();
    
    return $expense !== false ? $expense : null;
}