CREATE DATABASE IF NOT EXISTS db_inventory
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_inventory;
DROP TABLE IF EXISTS transactions, items, categories, users;
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
full_name VARCHAR(100),
role ENUM('admin','staff','manager') NOT NULL DEFAULT 'staff',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE categories (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
description TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE items (
id INT AUTO_INCREMENT PRIMARY KEY,
code VARCHAR(20) NOT NULL UNIQUE,
name VARCHAR(150) NOT NULL,
category_id INT NULL,
quantity INT NOT NULL DEFAULT 0,
unit VARCHAR(20) NOT NULL DEFAULT 'unit',
price DECIMAL(15,2) NOT NULL DEFAULT 0,
entry_date DATE NULL,
description TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
CONSTRAINT fk_items_category FOREIGN KEY (category_id)
REFERENCES categories(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE transactions (
id INT AUTO_INCREMENT PRIMARY KEY,
item_id INT NOT NULL,
user_id INT NOT NULL,
type ENUM('IN','OUT') NOT NULL,
quantity INT NOT NULL,
notes VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
CONSTRAINT fk_transactions_item FOREIGN KEY (item_id)
REFERENCES items(id) ON DELETE CASCADE,
CONSTRAINT fk_transactions_user FOREIGN KEY (user_id)
REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO users (username, password, full_name, role) VALUES
('admin', '$2y$10$tH0k34.kfNU/rTPy/Uaae.7CbN8QHXfRysqYNjR8Hofw2m5.5duJu', 'Administrator', 'admin'),
('staff1', '$2y$10$tH0k34.kfNU/rTPy/Uaae.7CbN8QHXfRysqYNjR8Hofw2m5.5duJu', 'Staff Gudang', 'staff'),
('manager1', '$2y$10$tH0k34.kfNU/rTPy/Uaae.7CbN8QHXfRysqYNjR8Hofw2m5.5duJu', 'Manajer', 'manager');
INSERT INTO categories (name, description) VALUES
('Elektronik', 'Peralatan elektronik'),
('ATK', 'Alat tulis kantor'),
('Furniture', 'Perabot kantor'),
('Aksesoris', 'Aksesoris komputer');
INSERT INTO items
(code, name, category_id, quantity, unit, price, entry_date, description)
VALUES
('BRG001', 'Laptop', 1, 10, 'unit', 7500000, '2026-01-10', 'Laptop operasional'),
('BRG002', 'Monitor', 1, 8, 'unit', 1800000, '2026-01-11', 'Monitor komputer'),
('BRG003', 'Keyboard', 1, 20, 'unit', 150000, '2026-01-12', 'Keyboard USB'),
('BRG004', 'Mouse', 1, 25, 'unit', 75000, '2026-01-12', 'Mouse USB'),
('BRG005', 'Flashdisk', 1, 15, 'unit', 85000, '2026-01-13', 'Flashdisk 32 GB'),
('BRG006', 'Buku Tulis', 2, 50, 'pcs', 5000, '2026-01-14', 'Buku tulis kantor'),
('BRG007', 'Pulpen', 2, 100, 'pcs', 3000, '2026-01-14', 'Pulpen tinta hitam'),
('BRG008', 'Pensil', 2, 60, 'pcs', 2500, '2026-01-15', 'Pensil HB'),
('BRG009', 'Kertas A4', 2, 30, 'rim', 55000, '2026-01-15', 'Kertas printer'),
('BRG010', 'Kursi Kantor', 3, 12, 'unit', 450000, '2026-01-16', 'Kursi kerja'),
('BRG011', 'Meja Kantor', 3, 6, 'unit', 1200000, '2026-01-16', 'Meja kerja'),
('BRG012', 'Kabel HDMI', 4, 18, 'pcs', 50000, '2026-01-17', 'Kabel HDMI 2 meter');
INSERT INTO transactions
(item_id, user_id, type, quantity, notes)
VALUES
(1, 1, 'IN', 5, 'Stok awal laptop'),
(2, 2, 'IN', 8, 'Penerimaan monitor'),
(3, 2, 'OUT', 2, 'Pengeluaran keyboard'),
(4, 3, 'OUT', 3, 'Pengeluaran mouse');
