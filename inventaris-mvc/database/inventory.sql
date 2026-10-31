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
        REFERENCES categories (id) ON DELETE SET NULL ON UPDATE CASCADE
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

INSERT INTO users (username, password, full_name, role) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin')
ON DUPLICATE KEY UPDATE password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

-- Bersihkan data lama agar tidak terjadi duplikasi ID
DELETE FROM transactions;
DELETE FROM items;
DELETE FROM categories;
DELETE FROM users;

-- 1. Insert Data User (Password: password)
INSERT INTO users (id, username, password, full_name, role) VALUES 
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin');

-- 2. Insert 4 Kategori Sesuai Target
INSERT INTO categories (id, name, description) VALUES 
(1, 'Elektronik', 'Peralatan elektronik dan gadget kantor'),
(2, 'ATK', 'Alat Tulis Kantor dan perlengkapan menulis'),
(3, 'Furniture', 'Perabot dan mebel ruangan kerja'),
(4, 'Peralatan Kebersihan', 'Alat dan bahan pembersih gedung');

-- 3. Insert 12 Barang (Tersebar di 4 kategori dengan berbagai stok)
INSERT INTO items (id, code, name, category_id, quantity, unit, price, entry_date, description) VALUES 
(1, 'ELK-001', 'Laptop Asus ROG', 1, 5, 'unit', 15000000.00, '2026-01-01', 'Laptop gaming kantor'),
(2, 'ELK-002', 'Monitor LG 24 inch', 1, 8, 'unit', 2100000.00, '2026-01-02', 'Monitor tambahan desain'),
(3, 'ELK-003', 'Keyboard Mechanical', 1, 15, 'pcs', 450000.00, '2026-01-03', 'Keyboard staff IT'),
(4, 'ATK-001', 'Kertas HVS A4 80gsm', 2, 50, 'rim', 52000.00, '2026-01-04', 'Kertas cetak dokumen'),
(5, 'ATK-002', 'Pulpen Standard Hitam', 2, 100, 'pcs', 3000.00, '2026-01-05', 'Alat tulis harian'),
(6, 'ATK-003', 'Buku Agenda Kerja', 2, 25, 'pcs', 15000.00, '2026-01-06', 'Buku catatan meeting'),
(7, 'ATK-004', 'Sticky Notes Warna', 2, 40, 'pak', 8000.00, '2026-01-07', 'Catatan pengingat cepat'),
(8, 'FUR-001', 'Kursi Kantor Ergonomis', 3, 10, 'unit', 1250000.00, '2026-01-08', 'Kursi staff'),
(9, 'FUR-002', 'Meja Kerja Minimalis', 3, 6, 'unit', 950000.00, '2026-01-09', 'Meja kayu staff'),
(10, 'FUR-003', 'Lemari Arsip Besi', 3, 3, 'unit', 2300000.00, '2026-01-10', 'Penyimpanan dokumen penting'),
(11, 'CLE-001', 'Cairan Pembersih Lantai', 4, 12, 'botol', 25000.00, '2026-01-11', 'Kebersihan ruangan'),
(12, 'CLE-002', 'Tissue Roll Jumbo', 4, 30, 'pack', 18000.00, '2026-01-12', 'Perlengkapan toilet kantor');