<?php
require_once(__DIR__ . '/../models/TaskModel.php');
class TaskDAO implements TaskDAOInterface
{
    private $connection;

    public function __construct()
    {
        $hostServer = "mysql:host=localhost:3306;dbname=tasks";
        $this->connection = new PDO($hostServer, 'root', 'Ackbar2846#2023');
    }

    public function insert(TaskModel $taskModel)
    {
        $sql = "INSERT INTO task (description, date, status) VALUES (?, ?, ?)";

        $stpr = $this->connection->prepare($sql);
        $stpr->bindValue(1, $taskModel->getDescription());
        $stpr->bindValue(2, $taskModel->getDate());
        $stpr->bindValue(3, $taskModel->getStatus());
        $stpr->execute(); 
    }

    public function update(TaskModel $taskModel)
    {
        $sql = "UPDATE task SET description=?, date=?, status=? WHERE id=?";

        $stpr = $this->connection->prepare($sql);
        $stpr->bindValue(1, $taskModel->getDescription());
        $stpr->bindValue(2, $taskModel->getDate());
        $stpr->bindValue(3, $taskModel->getStatus());
        $stpr->bindValue(4, $taskModel->getId());
        $stpr->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM task";

        $stpr = $this->connection->prepare($sql);
        $stpr->execute();
        
        return $stpr->fetchAll(PDO::FETCH_CLASS, 'TaskModel');      
    }

    public function selectById(int $id)
    {
        include_once __DIR__ . '/../models/TaskModel.php';

        $sql = "SELECT * FROM task WHERE id = ?";

        $stpr = $this->connection->prepare($sql);
        $stpr->bindValue(1, $id);
        $stpr->execute();

        return $stpr->fetchObject("TaskModel"); 
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM task WHERE id = ?";

        $stpr = $this->connection->prepare($sql);
        $stpr->bindValue(1, $id);
        $stpr->execute();
    }
}
