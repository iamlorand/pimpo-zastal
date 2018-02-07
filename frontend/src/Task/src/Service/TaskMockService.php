<?php
/**
 * Created by PhpStorm.
 * User: iamlorand
 * Date: 07.02.2018
 * Time: 11:38
 */

namespace Frontend\Task\Service;

use Dot\Mapper\Mapper\MapperManagerAwareInterface;
use Dot\Mapper\Mapper\MapperManagerAwareTrait;
use Frontend\Task\Entity\TaskEntity;

class TaskMockService implements TaskServiceInterface, MapperManagerAwareInterface
{
    use MapperManagerAwareTrait;

    public function addTask(TaskEntity $entity, array $options = [])
    {
        $mapper = $this->getMapperManager()->get(TaskEntity::class);
        $result = $mapper->save($entity);

        return $result;
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
