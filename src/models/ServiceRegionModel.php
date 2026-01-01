<?php

class serviceRegionModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        $query = "SELECT * FROM service_regions";
        return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByService($serviceId)
    {
        return $this->qry(
            "SELECT * FROM service_regions WHERE service_id = :service_id",
            ['service_id' => $serviceId]
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRegionsByService(int $serviceId): array
    {
        $stmt = $this->qry(
            "SELECT region_id
            FROM service_regions
            WHERE service_id = :service_id",
            ['service_id' => $serviceId]
        );

        return array_column(
            $stmt->fetchAll(PDO::FETCH_ASSOC),
            'region_id'
        );
    }

    public function deleteByService(int $serviceId): void
    {
        $this->qry(
            "DELETE FROM service_regions WHERE service_id = :service_id",
            ['service_id' => $serviceId]
        );
    }

    public function store($data) {
        $query = "INSERT INTO service_regions 
        (service_id, region_id, created_at, updated_at)
        VALUES (?, ?, NOW(), NOW())";
        return $this->qry($query, [
            $data['service_id'],
            $data['region_id'],
        ]);
    } 

    public function getById($id) {
        $query = "SELECT * FROM service_regions WHERE service_region_id = ?";
        return $this->qry($query, [$id])->fetch();
    }

    public function update($id, $data) {
        return $this->qry(
            "UPDATE service_regions SET
                service_id = :service_id,
                region_id  = :region_id,
                updated_at   = NOW()
            WHERE service_detail_id = :id",
            [
                'service_id'  => $data['service_id'],
                'region_id'   => $data['region_id'],
                'id'            => $id
            ]
        );
    }

    public function delete($id)
    {
        $this->qry(
            "DELETE FROM service_regions WHERE service_region_id = :id",
            ['id' => $id]
        );
    }
}