<?php
class User extends Model {
    protected string $table = 'users';

    public function findByUsername(string $username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}