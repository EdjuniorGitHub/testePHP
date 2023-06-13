<?php
    session_start();
    include('config.php');
    include('../Data/TaskDao.php');
    require_once '../app/models/TaskModel.php';
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <title>PHP</title>
</head>
<body>
  
    <div class="container mt-4">
        <?php include('alert.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tarefas
                            <a href="../app/views/create.php" class="btn btn-primary float-end">
                                <i class="bi bi-plus-lg"></i></a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Feito</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $taskDAO = new TaskDAO();
                                    $tasks = $taskDAO->select();
                                    
                                    if(count($tasks) > 0)
                                    {
                                        foreach($tasks as $task)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $task->getId(); ?></td>
                                                <td><?= $task->getDescription(); ?></td>
                                                <td><?= $task->getDate(); ?></td>
                                                <?php
                                                    if ($task->getStatus()==1) {
                                                        echo "<td><i class='bi bi-check'></td>";
                                                    } else{
                                                        echo "<td></td>";
                                                    }
                                                ?>
                                                <td>
                                                    <a href="../app/views/detail.php?id=<?= $task->getId(); ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                    <a href="../app/views/edit.php?id=<?= $task->getId(); ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                                    <form action="core.php" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza de que deseja excluir?');">
                                                        <input type="hidden" name="delete" value="<?= $task->getId(); ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-x"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> Nenhuma tarefa cadastrada </h5>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>