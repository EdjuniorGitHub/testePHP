<?php
include('../../Data/TaskDao.php');
require_once '../models/TaskModel.php';
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <title>Detalhes</title>
</head>
<body>

    <div class="container mt-5">
        <?php include('../alert.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tarefa 
                            <a href="../index.php" class="btn btn-danger float-end"><i class="bi bi-backspace"></i></a>
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
                                    <div class="mb-3">
                                        <label>Descrição</label>
                                        <p class="form-control">
                                            <?=$task->getDescription();?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Data</label>
                                        <p class="form-control">
                                            <?=$task->getDate();?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <?php
                                            if ($task->getStatus()==1) {
                                                echo "<p class='form-control'>Tarefa realizada</p>";
                                            } else{
                                                echo "<p class='form-control'>Tarefa pendente</p>";
                                            }
                                        ?>
                                    </div>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>