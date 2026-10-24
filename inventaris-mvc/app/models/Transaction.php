<?php
class Transaction extends Model {
    protected string $table = 'transactions';

    public function all(): array {
        return $this->db->query(
            "SELECT t.*, i.name AS item_name, i.code AS item_code, u.username AS user_name 
             FROM transactions t 
             JOIN items i ON t.item_id = i.id 
             JOIN users u ON t.user_id = u.id 
             ORDER BY t.created_at DESC"
        )->fetchAll();
    }

    public function createTransaction(array $data, int $currentStock, string $type): bool {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO transactions (item_id, user_id, type, quantity, notes) 
                 VALUES (:item_id, :user_id, :type, :quantity, :notes)"
            );
            $stmt->execute($data);

            $newStock = ($type === 'IN') ? ($currentStock + $data['quantity']) : ($currentStock - $data['quantity']);
            $upd = $this->db->prepare("UPDATE items SET quantity = ? WHERE id = ?");
            $upd->execute([$newStock, $data['item_id']]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getRecent(int $limit = 5): array {
    $stmt = $this->db->prepare(
        "SELECT t.*, i.name AS item_name, i.code AS item_code 
         FROM transactions t 
         JOIN items i ON t.item_id = i.id 
         ORDER BY t.created_at DESC LIMIT $limit"
    );
    $stmt->execute();
    return $stmt->fetchAll();
    }
}