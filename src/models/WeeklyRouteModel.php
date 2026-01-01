<?php

class WeeklyRouteModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        $query = "SELECT * FROM weekly_routes";
        return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBySubscription($subscription_id)
    {
        return $this->qry(
            "SELECT * FROM weekly_routes WHERE subscription_id = :subsctiption_id",
            ['subscription_id' => $subscription_id]
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store($data) {
        $query = "INSERT INTO weekly_routes 
        (subscription_id, weekday, created_at, updated_at)
        VALUES (?, ?, NOW(), NOW())";
        return $this->qry($query, [
            $data['subscription_id'],
            $data['weekday']
        ]);
    } 

    public function getById($id) {
        $query = "SELECT * FROM weekly_routes WHERE service_detail_id = ?";
        return $this->qry($query, [$id])->fetch();
    }

    public function update($id, $data) {
        return $this->qry(
            "UPDATE weekly_routes SET
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
            "DELETE FROM weekly_routes WHERE service_detail_id = :id",
            ['id' => $id]
        );
    }
}