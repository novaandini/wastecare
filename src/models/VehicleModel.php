<?php

class VehicleModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        $query = "SELECT * FROM vehicles";
        return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByService($region_id)
    {
        return $this->qry(
            "SELECT * FROM vehicles WHERE region_id = :region_id",
            ['region_id' => $region_id]
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store($data) {
        $query = "INSERT INTO vehicles 
        (region_id, vehicle_code, vehicle_name, type, capacity_kg, is_active, notes, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        return $this->qry($query, [
            $data['region_id'],
            $data['vehicle_code'],
            $data['vehicle_name'],
            $data['type'],
            $data['capacity_kg'],
            $data['is_active'],
            $data['notes'],
        ]);
    } 

    public function getById($id) {
        $query = "SELECT * FROM vehicles WHERE vehicle_id = ?";
        return $this->qry($query, [$id])->fetch();
    }

    public function update($id, $data) {
        return $this->qry(
            "UPDATE vehicles SET
                region_id = :region_id,
                vehicle_code  = :vehicle_code,
                vehicle_name = :vehicle_name,
                type = :type,
                capacity_kg = :capacity_kg,
                is_active = :is_active,
                notes = :notes,
                updated_at   = NOW()
            WHERE vehicle_id = :id",
            [
                'region_id'      => $data['region_id'],
                'vehicle_code'   => $data['vehicle_code'],
                'vehicle_name'   => $data['vehicle_name'],
                'type'           => $data['type'],
                'capacity_kg'    => $data['capacity_kg'],
                'is_active'      => $data['is_active'],
                'notes'          => $data['notes'],
                'id'             => $id
            ]
        );
    }

    public function delete($id)
    {
        $this->qry(
            "DELETE FROM vehicles WHERE vehicle_id = :id",
            ['id' => $id]
        );
    }
}