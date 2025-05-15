-- Benutzer Tabelle
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Produkte Tabelle
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Kategorien Tabelle
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT
);

-- Produkt-Kategorie Zuordnung
CREATE TABLE IF NOT EXISTS product_categories (
    product_id INT,
    category_id INT,
    PRIMARY KEY (product_id, category_id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Bestellungen Tabelle
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bestellpositionen Tabelle
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Beispieldaten für Benutzer
INSERT INTO users (username, email, password) VALUES
('max_mustermann', 'max@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('anna_schmidt', 'anna@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('peter_mueller', 'peter@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Beispieldaten für Kategorien
INSERT INTO categories (name, description) VALUES
('Elektronik', 'Elektronische Geräte und Zubehör'),
('Bücher', 'Bücher aller Art'),
('Kleidung', 'Mode und Accessoires'),
('Sport', 'Sportartikel und Ausrüstung');

-- Beispieldaten für Produkte
INSERT INTO products (name, description, price, stock) VALUES
('Smartphone XY', 'Neuestes Smartphone Modell', 699.99, 50),
('Laptop Pro', 'Leistungsstarker Laptop', 1299.99, 30),
('Python Programmierung', 'Lehrbuch für Anfänger', 29.99, 100),
('Laufschuhe Sport', 'Bequeme Sportschuhe', 89.99, 75),
('T-Shirt Basic', 'Klassisches T-Shirt', 19.99, 200);

-- Produkt-Kategorie Zuordnungen
INSERT INTO product_categories (product_id, category_id) VALUES
(1, 1), -- Smartphone -> Elektronik
(2, 1), -- Laptop -> Elektronik
(3, 2), -- Python Buch -> Bücher
(4, 4), -- Laufschuhe -> Sport
(5, 3); -- T-Shirt -> Kleidung

-- Beispiel-Bestellungen
INSERT INTO orders (user_id, total_amount, status) VALUES
(1, 729.98, 'delivered'),  -- Max's Bestellung
(2, 1299.99, 'processing'), -- Anna's Bestellung
(3, 109.98, 'pending');    -- Peter's Bestellung

-- Beispiel-Bestellpositionen
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 699.99),  -- Max kauft ein Smartphone
(1, 3, 1, 29.99),   -- und ein Buch
(2, 2, 1, 1299.99), -- Anna kauft einen Laptop
(3, 4, 1, 89.99),   -- Peter kauft Laufschuhe
(3, 3, 1, 19.99);   -- und ein T-Shirt