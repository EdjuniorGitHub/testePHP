<?php
class TaskModel
{
    private $id;
    private $description;
    private $date;
    private $status;

    public function __construct() {}
    
    public function getId() {
        return $this->id;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getDate() {
        return $this->date;
    }
    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setDate($date) {
        $this->date = $date;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
}
