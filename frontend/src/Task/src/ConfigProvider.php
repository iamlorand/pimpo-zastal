<?php
/**
 * @see https://github.com/dotkernel/frontend/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/frontend/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace Frontend\Task;

use Dot\Mapper\Factory\DbMapperFactory;
use Frontend\Task\Entity\TaskEntity;
use Frontend\Task\Form\TaskForm;
use Frontend\Task\Form\TaskFieldset;
use Frontend\Task\Mapper\TaskDbMapper;
use Frontend\Task\Service\TaskMockService;
use Frontend\Task\Service\TaskServiceInterface;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Class ConfigProvider
 * @package Frontend\Task
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),

            'templates' => $this->getTemplates(),

            'dot_form' => $this->getForms(),

            'dot_mapper' => $this->getMappers(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                TaskMockService::class => InvokableFactory::class,
            ],
            'aliases' => [
                TaskServiceInterface::class => TaskMockService::class,
                'TaskService' => TaskServiceInterface::class,
            ]
        ];
    }

    public function getMappers(): array
    {
        return [
            'mapper_manager' => [
                'factories' => [
                    TaskDbMapper::class => DbMapperFactory::class,
                ],
                'aliases' => [
                    TaskEntity::class => TaskDbMapper::class,
                ]
            ]
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'category' => [__DIR__ . '/../templates/category'],
                'task' => [__DIR__ . '/../templates/task'],
            ],
        ];
    }

    public function getForms()
    {
        return [
            'form_manager' => [
                'invokables' => [
                    TaskForm::class => TaskForm::class,
                ],
                'factories' => [
                    TaskFieldset::class => InvokableFactory::class,
                ],
                'aliases' => [
                    'TaskFieldset' => TaskFieldset::class,
                    'TaskForm' => TaskForm::class,
                ]
            ],
        ];
    }
}
