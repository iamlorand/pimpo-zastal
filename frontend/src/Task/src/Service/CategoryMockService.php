<?php
/**
 * Created by PhpStorm.
 * User: iamlorand
 * Date: 08.02.2018
 * Time: 14:29
 */

namespace Frontend\Task\Service;


use Dot\Mapper\Mapper\MapperManagerAwareInterface;
use Dot\Mapper\Mapper\MapperManagerAwareTrait;
use Frontend\Task\Entity\CategoryEntity;

class CategoryMockService implements CategoryServiceInterface, MapperManagerAwareInterface
{
    use MapperManagerAwareTrait;

    public function addCategory(CategoryEntity $entity, array $options = [])
    {
        // TODO: Implement addCategory() method.
    }

    public function updateCategory(CategoryEntity $entity, array $options = [])
    {
        // TODO: Implement updateCategory() method.
    }

    public function listCategory(array $options = [])
    {
        $mapper = $this->getMapperManager()->get(CategoryEntity::class);
        $result = $mapper->find('all');

        return $result;
    }

    public function getCategory(int $categoryId, array $options = [])
    {
        // TODO: Implement getCategory() method.
    }

    public function deleteCategory(CategoryEntity $entity, array $options = [])
    {
        // TODO: Implement deleteCategory() method.
    }
}
