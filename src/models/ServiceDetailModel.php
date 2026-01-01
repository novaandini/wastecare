<?php

class ServiceDetailModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        $query = "SELECT * FROM service_details";
        return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByService($serviceId)
    {
        return $this->qry(
            "SELECT * FROM service_details WHERE service_id = :service_id",
            ['service_id' => $serviceId]
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store($data) {
        $query = "INSERT INTO service_details 
        (service_id, title, content, created_at, updated_at)
        VALUES (?, ?, ?, NOW(), NOW())";
        return $this->qry($query, [
            $data['service_id'],
            $data['title'],
            $data['content']
        ]);
    } 

    public function getById($id) {
        $query = "SELECT * FROM service_details WHERE service_detail_id = ?";
        return $this->qry($query, [$id])->fetch();
    }

    public function update($id, $data) {
        return $this->qry(
            "UPDATE service_details SET
                title  = :title,
                content = :content,
                updated_at   = NOW()
            WHERE service_detail_id = :id",
            [
                'title'   => $data['title'],
                'content'   => $data['content'],
                'id'            => $id
            ]
        );
    }

    public function delete($id)
    {
        $this->qry(
            "DELETE FROM service_details WHERE service_detail_id = :id",
            ['id' => $id]
        );
    }
}