<?php

interface TaskDAOInterface
{
    public function insert(TaskModel $taskModel);
    public function update(TaskModel $taskModel);
    public function select();
    public function selectById(int $id);
    public function delete(int $id);
}
