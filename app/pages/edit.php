<?php
session_start();
include('../../Data/TaskDao.php');
require_once '../../models/TaskModel.php';
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <title>Editar</title>
</head>
<body>
    <div class="container mt-5">
        <?php include('../alert.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar 
                            <a href="index.php" class="btn btn-danger float-end"><i class="bi bi-backspace"></i></a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_GET['id']))
                        {
                            $taskDAO = new TaskDAO();
                            $task = $taskDAO->selectById($_GET['id']);
                            
                            if(!empty($task))
                            {
                                ?>
                                <form action="edit.php" method="POST">
                                    <input type="hidden" name="task_id" value="<?= $task->getId(); ?>">
                                    <div class="mb-3">
                                        <label>Descrição</label>
                                        <input type="text" name="description" value="<?=$task->getDescription();?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Data</label>
                                        <input type="text" name="date" value="<?=$task->getDate();?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <input type="checkbox" name="status" id="status" >
                                        <label for="status">Tarefa concluída</label>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update" class="btn btn-primary">
                                            Atualizar tarefa
                                        </button>
                                    </div>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>Tarefa não encontrada</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['update'])) {
        $description = $_POST['description'] ?? null;
        $date = $_POST['date'] ?? null;
        $status = $_POST['status'] ?? null;
        $id = $_POST['task_id'] ?? null;
        
        if($id != null)
        {
            $taskModel = new TaskModel();
            $taskModel->setDescription($description);
            $taskModel->setDate($date);
            $taskModel->setStatus($status == 'on' ? 1 : 0);
            $taskModel->setId($id);

            $taskDAO = new TaskDAO();
            $taskDAO->update($taskModel);

            $_SESSION['message'] = "Tarefa atualizada com sucesso!";
        }
        else
        {
            $_SESSION['message'] = "Tarefa não encontrada.";
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>