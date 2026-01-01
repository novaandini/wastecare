<?php

class ServicePackageModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        $query = "SELECT * FROM service_packages";
        return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByService($serviceId)
    {
        return $this->qry(
            "SELECT * FROM service_packages WHERE service_id = :service_id",
            ['service_id' => $serviceId]
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store($data) {
        $query = "INSERT INTO service_packages 
        (service_id, package_name, duration_type, duration_value, price_per_kk, is_active, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        return $this->qry($query, [
            $data['service_id'],
            $data['package_name'],
            $data['duration_type'],
            $data['duration_value'],
            $data['price_per_kk'],
            $data['is_active']
        ]);
    } 

    public function getById($id) {
        $query = "SELECT * FROM service_packages WHERE service_package_id = ?";
        return $this->qry($query, [$id])->fetch();
    }

    public function update($id, $data) {
        return $this->qry(
            "UPDATE service_packages SET
                package_name  = :package_name,
                duration_type  = :duration_type,
                duration_value = :duration_value,
                price_per_kk = :price_per_kk,
                is_active = :is_active,
                updated_at   = NOW()
            WHERE service_package_id = :id",
            [
                'package_name'   => $data['package_name'],
                'duration_type'   => $data['duration_type'],
                'duration_value'   => $data['duration_value'],
                'price_per_kk'   => $data['price_per_kk'],
                'is_active'   => $data['is_active'],
                'id'            => $id
            ]
        );
    }

    public function delete($id)
    {
        $this->qry(
            "DELETE FROM service_packages WHERE service_package_id = :id",
            ['id' => $id]
        );
    }
}