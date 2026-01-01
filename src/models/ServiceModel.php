<?php

class ServiceModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($userId = null)
    {
        if ($userId !== null) {
            return $this->qry(
                "SELECT * FROM services WHERE user_id = :user_id",
                ['user_id' => $userId]
            )->fetchAll(PDO::FETCH_ASSOC);
        }

        return $this->qry(
            "SELECT * FROM services"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $now = date('Y-m-d H:i:s');

        $this->qry(
            "INSERT INTO services (
                user_id,
                name,
                description,
                image,
                is_active,
                created_at,
                updated_at
            ) VALUES (
                :user_id,
                :name,
                :description,
                :image,
                :is_active,
                :created_at,
                :updated_at
            )",
            [
                'user_id'       => $data['user_id'],
                'name'          => $data['name'],
                'description'   => $data['description'],
                'image' => $data['image'] ?? null,
                'is_active'     => $data['is_active'],
                'created_at'    => $now,
                'updated_at'    => $now,
            ]
        );

        return $this->conn->lastInsertId();
    }

    public function findById($id)
    {
        return $this->qry(
            "SELECT * FROM services WHERE service_id = :id",
            ['id' => $id]
        )->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        return $this->qry(
            "UPDATE services SET
                name = :name,
                description  = :description,
                image = :image,
                is_active    = :is_active,
                updated_at   = NOW()
            WHERE service_id = :id",
            [
                'name'  => $data['name'],
                'description'   => $data['description'],
                'image' => $data['image'],
                'is_active'     => $data['is_active'],
                'id'            => $id
            ]
        );
    }

    public function delete($id)
    {
        $this->qry(
            "DELETE FROM services WHERE service_id = :id",
            ['id' => $id]
        );
    }
}