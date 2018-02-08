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
use Zend\Db\Sql\Select;

class TaskMockService implements TaskServiceInterface, MapperManagerAwareInterface
{
    use MapperManagerAwareTrait;

    public function addTask(TaskEntity $entity, array $options = [])
    {

    }

    public function updateTask(TaskEntity $entity, array $options = [])
    {

    }

    public function listTask(array $options = [])
    {

    }

    public function getTask(int $taskId, array $options = [])
    {

    }

    public function deleteTask(TaskEntity $entity, array $options = [])
    {

    }

    public function listTaskByDate(array $options = [])
    {
//        $options['conditions'] = [
//            "date LIKE '2017%'"
//        ];

        $mapper = $this->getMapperManager()->get(TaskEntity::class);
        $result = $mapper->find('all', $options);

        return $result;
    }
}
