<?php
/**
 * Created by PhpStorm.
 * User: iamlorand
 * Date: 07.02.2018
 * Time: 11:05
 */

namespace Frontend\Task\Mapper;

use Dot\Hydrator\ClassMethodsCamelCase;
use Dot\Mapper\Event\MapperEvent;
use Dot\Mapper\Mapper\AbstractDbMapper;
use Frontend\Task\Entity\CategoryEntity;
use Frontend\Task\Entity\TaskEntity;
use Zend\Db\Sql\Select;

class TaskDbMapper extends AbstractDbMapper
{
    protected $table = 'task';

    protected $categoryPrototype;

    protected $categoryHydrator;

    public function onAfterLoad(MapperEvent $e)
    {
        $this->categoryPrototype = new CategoryEntity();
        $this->categoryHydrator = new ClassMethodsCamelCase();

        parent::onAfterLoad($e);

        /** @var TaskEntity $entity */
        $task = $e->getParam('entity');

        /** @var array $data */
        $data = $e->getParam('data');

        $categoryData = array_filter($data['Category']);
        if (!empty($categoryData)) {
            $details = $this->categoryHydrator->hydrate(
                array_filter($data['Category']),
                clone $this->categoryPrototype
            );
            $task->setCategory($details);
        } else {
            $task->setCategory(new CategoryEntity());
        }
    }
//
    /**
     * @param string $type
     * @param array $options
     * @return array
     */
    public function find(string $type = 'all', array $options = []): array
    {
        $options['joins'] = $options['joins'] ?? [];
        // append a join condition to the options
        // for user details every time we fetch users
        $options['joins'] += [
            'Category' => [
                'on' => 'Category.id = Task.categoryId',
                'type' => Select::JOIN_LEFT
            ]
        ];

        return parent::find($type, $options);
    }
}