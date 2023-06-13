<?php
session_start();
require 'config.php';

if(isset($_POST['delete']))
{
    $task_id = mysqli_real_escape_string($con, $_POST['delete']);

    $query = "DELETE FROM task WHERE id='$task_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Tarefa excluida com sucesso";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Não foi possivel excluir a tarefa";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update']))
{
    $task_id = mysqli_real_escape_string($con, $_POST['task_id']);

    $description = mysqli_real_escape_string($con, $_POST['description']);
    $status = (isset($_POST['status']))? 1: 0;
    
    $query = "UPDATE task SET description='$description', status=$status WHERE id=$task_id ";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Tarefa atualizada";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Tarefa não atualizada";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['save']))
{
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $status = (isset($_POST['status']))? 1: 0;
    
    $query = "INSERT INTO task (description, status) VALUES ('$description','$status')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Tarefa cadastrada com sucesso!";
        header("Location: create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "tarefa não cadastrada";
        header("Location: create.php");
        exit(0);
    }
}