<?php

class ServiceModel extends Database {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        $query = "SELECT * FROM services";
        return $this->qry($query)->fetchAll();
    }
}