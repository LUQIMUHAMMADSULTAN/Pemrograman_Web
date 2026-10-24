<?php
class Item extends Model {
    protected string $table = 'items';

    public function all(): array {
        return $this->db->query(
            "SELECT i.*, c.name AS category_name 
             FROM items i 
             LEFT JOIN categories c ON i.category_id = c.id 
             ORDER BY i.created_at DESC"
        )->fetchAll();
    }

    public function find(int $id) {
        $stmt = $this->db->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO items (code, name, category_id, quantity, unit, price, entry_date, description) 
             VALUES (:code, :name, :category_id, :quantity, :unit, :price, :entry_date, :description)"
        );
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool {
        $data['id'] = $id;
        $stmt = $this->db->prepare(
            "UPDATE items SET code = :code, name = :name, category_id = :category_id, 
             quantity = :quantity, unit = :unit, price = :price, entry_date = :entry_date, description = :description 
             WHERE id = :id"
        );
        return $stmt->execute($data);
    }

    public function paginate(int $limit, int $offset, ?string $search = null, ?int $categoryId = null): array {
        $sql = "SELECT i.*, c.name AS category_name 
                FROM items i 
                LEFT JOIN categories c ON i.category_id = c.id 
                WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (i.code LIKE ? OR i.name LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if (!empty($categoryId)) {
            $sql .= " AND i.category_id = ?";
            $params[] = $categoryId;
        }

        $sql .= " ORDER BY i.created_at DESC LIMIT $limit OFFSET $offset";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function countAll(?string $search = null, ?int $categoryId = null): int {
        $sql = "SELECT COUNT(*) as total FROM items i WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (i.code LIKE ? OR i.name LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if (!empty($categoryId)) {
            $sql .= " AND i.category_id = ?";
            $params[] = $categoryId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return (int)$stmt->fetch()['total'];
    }

    public function countLowStock(int $threshold = 5): int {
    $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM items WHERE quantity <= ?");
    $stmt->execute([$threshold]);
    return (int)$stmt->fetch()['total'];
    }   
}