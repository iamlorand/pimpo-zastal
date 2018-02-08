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
        $mapper = $this->getMapperManager()->get(TaskEntity::class);
        $result = $mapper->save($entity);

        return $result;
    }

    public function updateTask(TaskEntity $entity, array $options = [])
    {
        $mapper = $this->getMapperManager()->get(TaskEntity::class);
        $result = $mapper->save($entity);

        return $result;
    }

    public function listTask(array $options = [])
    {
        $mapper = $this->getMapperManager()->get(TaskEntity::class);
        $result = $mapper->find('all', $options);

        return $result;
    }

    public function getTask(int $taskId, array $options = [])
    {
        $mapper = $this->getMapperManager()->get(TaskEntity::class);
        $result = $mapper->get($taskId);

        return $result;
    }

    public function deleteTask(TaskEntity $entity, array $options = [])
    {
        $mapper = $this->getMapperManager()->get(TaskEntity::class);
        $result = $mapper->delete($entity);

        return $result;
    }
}