<?php

class InstitutionModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data) {
        $now = date('Y-m-d H:i:s');
        $this->qry("INSERT INTO institutions (user_id, business_name, brn, address, phone_number, social_media, created_at, updated_at) VALUES (:user_id, :business_name, :brn, :address, :phone_number, :social_media, :created_at, :updated_at)", [
            ':user_id' => $data['user_id'],
            ':business_name' => $data['business_name'],
            ':brn' => $data['brn'],
            ':phone_number' => $data['phone_number'],
            ':address' => $data['address'],
            ':social_media' => $data['social_media'],
            ':created_at' => $now,
            ':updated_at' => $now,
        ]);
        // return $stmt;
        return $this->conn->lastInsertId();
    }

    public function findByBRN($brn) {
        $stmt = $this->qry("SELECT * FROM institutions WHERE brn = :brn LIMIT 1", ['brn' => $brn]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}