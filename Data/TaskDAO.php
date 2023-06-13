<?php
require_once(__DIR__ . '/../app/models/TaskModel.php');
/**
 * Clase onde estão os métodos de acesso ao banco
 * @author edjun
 */
class TaskDAO
{
    private $connection;

    public function __construct()
    {
        $hostServer = "mysql:host=localhost:3306;dbname=tasks";
        $this->connection = new PDO($hostServer, 'root', 'Ackbar2846#2023');
    }

    /**
     * Métodos CRUD insert
     * recebe uma task model
     */
    public function insert(TaskModel $taskModel)
    {
        echo 'oi';
        $sql = "INSERT INTO task (description, date, status) VALUES (?, ?, ?)";

        $stpr = $this->connection->prepare($sql);
        $stpr->bindValue(1, $taskModel->description);
        $stpr->bindValue(2, $taskModel->date);
        $stpr->bindValue(2, $taskModel->status);
        $stpr->execute();
    }

    /**
     * Métodos CRUD update de uma tarefa especidica (id)
     * recebe uma task model
     */
    public function update(TaskModel $taskModel)
    {
        $sql = "UPDATE tasks SET description=?, date=?, status=? WHERE id=?";

        $stpr = $this->connection->prepare($sql);
        $stpr->bindValue(1, $taskModel->description);
        $stpr->bindValue(2, $taskModel->date);
        $stpr->bindValue(3, $taskModel->status);
        $stpr->bindValue(43, $taskModel->id);
        $stpr->execute();
    }

    /**
     * Retorna todas as taks
     */
    public function select()
    {
        $sql = "SELECT * FROM task";

        $stpr = $this->connection->prepare($sql);
        $stpr->execute();
        
        return $stpr->fetchAll(PDO::FETCH_CLASS, 'TaskModel');      
    }

    /**
     * Retorna uma task específica de um ID
     */
    public function selectById(int $id)
    {
        include_once __DIR__ . '/../app/models/TaskModel.php';

        $sql = "SELECT * FROM task WHERE id = ?";

        $stpr = $this->connection->prepare($sql);
        $stpr->bindValue(1, $id);
        $stpr->execute();

        return $stpr->fetchObject("TaskModel"); 
    }

    /**
     * Apaga uma tarefa especifica
     */
    public function delete(int $id)
    {
        $sql = "DELETE FROM tasks WHERE id = ?";

        $stpr = $this->connection->prepare($sql);
        $stpr->bindValue(1, $id);
        $stpr->execute();
    }
}
