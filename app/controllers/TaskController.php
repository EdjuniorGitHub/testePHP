<?php
include '../models/TaskModel.php';

class TaskController
{
    public function insertTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $description = $_POST['description'] ?? null;
            $date = $_POST['date'] ?? null;
            $status = $_POST['status'] ?? null;

            $taskModel = new TaskModel();
            $taskModel->setDescription($description);
            $taskModel->setDate($date);
            $taskModel->setStatus($status);

            $taskDAO = new TaskDAO();
            $taskDAO->insert($taskModel);
        }

        header('Location: /views/create.php');
        exit;
    }
}
