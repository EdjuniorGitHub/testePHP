<?php
session_start();
include('../../data/TaskDao.php');
require_once '../../models/TaskModel.php';
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <title>Nova tarefa</title>
</head>
<body>
  
    <div class="container mt-5">
        <?php include('../alert.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Adicionar tarefa
                            <a href="index.php" class="btn btn-danger float-end"><i class="bi bi-backspace"></i></a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="create.php" method="POST">
                            <div class="mb-3">
                                <label>Descrição</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Date</label>
                                <input type="text" name="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" name="status" id="status" >
                                <label for="status">Tarefa concluída</label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="save" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['save'])) {
        $description = $_POST['description'] ?? null;
        $date = $_POST['date'] ?? null;
        $status = $_POST['status'] ?? null;
        
        $taskModel = new TaskModel();
        $taskModel->setDescription($description);
        $taskModel->setDate($date);
        $taskModel->setStatus($status == 'on' ? 1 : 0);

        $taskDAO = new TaskDAO();
        $taskDAO->insert($taskModel);
        
        $_SESSION['message'] = "Tarefa cadastrada com sucesso!";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>