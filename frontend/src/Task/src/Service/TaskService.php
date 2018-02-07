<?php
/**
 * Created by PhpStorm.
 * User: iamlorand
 * Date: 07.02.2018
 * Time: 11:54
 */

namespace Frontend\Task\Service;

use Dot\Mapper\Mapper\MapperManagerAwareInterface;
use Dot\Mapper\Mapper\MapperManagerAwareTrait;
use Frontend\Task\Entity\TaskEntity;

class TaskService implements TaskServiceInterface, MapperManagerAwareInterface
{
    use MapperManagerAwareTrait;

    public function addTask(TaskEntity $entity, array $options = [])
    {
        // TODO: Implement addTask() method.
    }
    public function updateTask(TaskEntity $entity, int $taskId, array $options = [])
    {
        // TODO: Implement updateTask() method.
    }
    public function listTask(array $options = [])
    {
        // TODO: Implement listTask() method.
    }
    public function getTask(int $taskId, array $options = [])
    {
        // TODO: Implement getTask() method.
    }
    public function deleteTask(int $taskId, array $options = [])
    {
        // TODO: Implement deleteTask() method.
    }
}