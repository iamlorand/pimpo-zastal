<?php
/**
 * Created by PhpStorm.
 * User: iamlorand
 * Date: 07.02.2018
 * Time: 11:39
 */

namespace Frontend\Task\Service;

use Frontend\Task\Entity\CategoryEntity;

interface CategoryServiceInterface
{
    /**
     * Add new category
     *
     * @param CategoryEntity $entity
     * @param array $options
     * @return mixed
     */
    public function addCategory(CategoryEntity $entity, array $options = []);

    /**
     * Update existing category
     *
     * @param CategoryEntity $entity
     * @param array $options
     * @return mixed
     */
    public function updateCategory(CategoryEntity $entity, array $options = []);

    /**
     * List all existing category
     * @param array $options
     * @return mixed
     */
    public function listCategory(array $options = []);

    /**
     * Return the requested category
     *
     * @param int $categoryId
     * @param array $options
     * @return mixed
     */
    public function getCategory(int $categoryId, array $options = []);

    /**
     * Delete a category
     *
     * @param CategoryEntity $entity
     * @param array $options
     * @return mixed
     */
    public function deleteCategory(CategoryEntity $entity, array $options = []);
}
