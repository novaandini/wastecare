<?php

class SubscriptionModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        $query = "SELECT * FROM subscriptions";
        return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByService($serviceId)
    {
        return $this->qry(
            "SELECT * FROM subscriptions WHERE service_id = :service_id",
            ['service_id' => $serviceId]
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUser($userId)
    {
        return $this->qry(
            "SELECT * FROM subscriptions WHERE user_id = :user_id",
            ['user_id' => $userId]
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByStatus($status)
    {
        return $this->qry(
            "SELECT * FROM subscriptions WHERE status = :status",
            ['status' => $status]
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store($data) {
        $query = "INSERT INTO subscriptions 
        (user_id, service_id, service_package_id, total_kk, price_per_kk, total_price, contact_name, contact_phone, contact_address, status, start_date, end_date, village_name, district_name, city_name, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', null, null, ?, ?, ?, NOW(), NOW())";
        $this->qry($query, [
            $data['user_id'],
            $data['service_id'],
            $data['service_package_id'],
            $data['total_kk'],
            $data['price_per_kk'],
            $data['total_price'],
            $data['contact_name'],
            $data['contact_phone'],
            $data['contact_address'],
            $data['village_name'],
            $data['district_name'],
            $data['city_name']
        ]);

        return $this->conn->lastInsertId();
    } 

    public function getById($id) {
        $query = "SELECT * FROM subscriptions WHERE subscription_id = ?";
        return $this->qry($query, [$id])->fetch();
    }

    public function update($id, $data) {
        return $this->qry(
            "UPDATE subscriptions SET
                status  = :status,
                start_date = :start_date,
                end_date = :end_date,
                updated_at   = NOW()
            WHERE subscription_id = :id",
            [
                'status'   => $data['status'],
                'start_date'   => $data['start_date'],
                'end_date'   => $data['end_date'],
                'id'            => $id
            ]
        );
    }
}