-- Création de la table des catégories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Création de la table des dépenses avec index sur expense_date
CREATE TABLE IF NOT EXISTS expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10,2) NOT NULL,
    expense_date DATE NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    category_id INT NOT NULL,
    CONSTRAINT fk_expenses_category 
        FOREIGN KEY (category_id) 
        REFERENCES categories(id) 
        ON DELETE RESTRICT,
    INDEX idx_expense_date (expense_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertion des catégories de base
INSERT INTO categories (name) VALUES 
('Alimentation'),
('Transport'),
('Logement'),
('Loisirs'),
('Santé'),
('Autres');

-- Insertion de données de démonstration réparties sur 3 mois
INSERT INTO expenses (amount, expense_date, description, category_id) VALUES 
-- Août 2026
(650.00, '2026-08-01', 'Loyer d''août', 3),
(115.50, '2026-08-12', 'Courses supermarché', 1),
(45.00, '2026-08-25', 'Plein d''essence', 2),

-- Septembre 2026
(650.00, '2026-09-01', 'Loyer de septembre', 3),
(98.20, '2026-09-06', 'Ravitaillement courses', 1),
(55.00, '2026-09-14', 'Restaurant', 4),
(19.99, '2026-09-22', 'Achat divers (Catégorie Autres)', 6),

-- Octobre 2026
(650.00, '2026-10-01', 'Loyer d''octobre', 3),
(45.50, '2026-10-02', 'Courses au supermarché', 1),
(12.90, '2026-10-03', 'Ticket de métro / Bus', 2),
(30.00, '2026-10-10', 'Séance de cinéma', 4),
(25.00, '2026-10-12', 'Pharmacie', 5);