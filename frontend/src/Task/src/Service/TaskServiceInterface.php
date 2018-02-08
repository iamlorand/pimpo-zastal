<?php
/**
 * Created by PhpStorm.
 * User: iamlorand
 * Date: 07.02.2018
 * Time: 11:39
 */

namespace Frontend\Task\Service;

use Frontend\Task\Entity\TaskEntity;

interface TaskServiceInterface
{
    /**
     * Add new task
     *
     * @param TaskEntity $entity
     * @param array $options
     * @return mixed
     */
    public function addTask(TaskEntity $entity, array $options = []);

    /**
     * Update an existing task
     *
     * @param TaskEntity $entity
     * @param array $options
     * @return mixed
     */
    public function updateTask(TaskEntity $entity, array $options = []);

    /**
     * List all tasks
     *
     * @param array $options
     * @return mixed
     */
    public function listTask(array $options = []);

    /**
     * Returns a TaskEntity for the requested $taskId if exists
     *
     * @param int $taskId
     * @param array $options
     * @return mixed
     */
    public function getTask(int $taskId, array $options = []);

    /**
     * Deletes a TaskEntity with the requested $taskId if exists
     *
     * @param TaskEntity $entity
     * @param array $options
     * @return mixed
     */
    public function deleteTask(TaskEntity $entity, array $options = []);
}
