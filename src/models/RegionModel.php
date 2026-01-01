<?php

class RegionModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        $query = "SELECT * FROM regions";
        return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store($data) {
        $query = "INSERT INTO regions 
        (region_name, province, created_at, updated_at)
        VALUES (?, ?, NOW(), NOW())";
        return $this->qry($query, [
            $data['region_name'],
            $data['province'],
        ]);
    } 

    public function getById($id) {
        $query = "SELECT * FROM regions WHERE region_id = ?";
        return $this->qry($query, [$id])->fetch();
    }

    public function update($id, $data) {
        return $this->qry(
            "UPDATE regions SET
                region_name = :region_name,
                province  = :province,
                updated_at   = NOW()
            WHERE region_id = :id",
            [
                'region_name'  => $data['region_name'],
                'province'   => $data['province'],
                'id'            => $id
            ]
        );
    }

    public function delete($id)
    {
        $this->qry(
            "DELETE FROM regions WHERE region_id = :id",
            ['id' => $id]
        );
    }
}