<?php

class UserModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data) {
        $now = date('Y-m-d H:i:s');
        $this->qry("INSERT INTO users (role, name, email, password, phone_number, address, created_at, updated_at) VALUES (:role, :name, :email, :password, :phone_number, :address, :created_at, :updated_at)", [
            ':role' => $data['role'],
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':phone_number' => $data['phone_number'],
            ':address' => $data['address'],
            ':created_at' => $now,
            ':updated_at' => $now,
        ]);
        return $this->conn->lastInsertId();
    }

    public function findByEmail($email) {
        $stmt = $this->qry("SELECT * FROM users WHERE email = :email LIMIT 1", [':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->qry("SELECT * FROM users WHERE user_id = :user_id LIMIT 1", [':user_id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByRole($role) {
        return $this->qry(
            "SELECT * FROM users WHERE role = :role",
            ['role' => $role]
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        return $this->qry(
            "UPDATE users SET
                name  = :name,
                password  = :password,
                phone_number = :phone_number,
                address = :address,
                updated_at   = NOW()
            WHERE user_id = :id",
            [
                'name'   => $data['name'],
                'password'   => $data['password'],
                'phone_number'   => $data['phone_number'],
                'address'   => $data['address'],
                'id'            => $id
            ]
        );
    }

    public function delete($id)
    {
        $this->qry(
            "DELETE FROM users WHERE user_id = :id",
            ['id' => $id]
        );
    }
}