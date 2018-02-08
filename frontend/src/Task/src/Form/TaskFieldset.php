<?php
/**
 * @see https://github.com/dotkernel/frontend/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/frontend/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace Frontend\Task\Form;

use Dot\Hydrator\ClassMethodsCamelCase;
use Frontend\App\Entity\UserMessageEntity;
use Frontend\Task\Entity\TaskEntity;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Class TaskFieldset
 * @package Frontend\Task\Form
 */
class TaskFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('taskForm');

        $this->setObject(new TaskEntity());
        $this->setHydrator(new ClassMethodsCamelCase());
    }

    public function init()
    {
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title'
            ],
            'attributes' => [
                'placeholder' => 'Task title...'
            ]
        ]);

        $this->add([
            'name' => 'description',
            'type' => 'textarea',
            'options' => [
                'label' => 'Description'
            ],
            'attributes' => [
                'id' => 'taskMessage_textarea',
                'placeholder' => 'Enter task description...',
                'rows' => 5,
            ]
        ]);

        $this->add([
            'name' => 'categoryId',
            'type' => 'select',
            'options' => [
                'label' => 'Category',
                'value_options' => [],
            ],
            'attributes' => [
                'placeholder' => 'Enter categoryId...'
            ]
        ]);

        $this->add([
            'name' => 'minutes',
            'type' => 'text',
            'options' => [
                'label' => 'Time'
            ],
            'attributes' => [
                'placeholder' => 'Enter time in minutes...'
            ]
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'filters' => [
                    ['name' => 'StringTrim']
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'message' => '<b>Title</b> is required and cannot be empty',
                        ]
                    ],
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 3,
                            'max' => 25,
                            'message' => '<b>Title</b> length invalid!'
                        ]
                    ],
                ],
            ],
            'description' => [
                'filters' => [
                    ['name' => 'StringTrim']
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'max' => 500,
                            'message' => 'Your <b>Description</b> length is too long!'
                        ]
                    ]
                ],
            ],
            'categoryId' => [
                'filters' => [
                    ['name' => 'StringTrim']
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'message' => '<b>Category</b> is required and cannot be empty',
                        ]
                    ],
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'max' => 10,
                        ]
                    ]
                ],
            ],
            'minutes' => [
                'filters' => [
                    ['name' => 'StringTrim']
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'message' => '<b>Minutes</b> is required and cannot be empty',
                        ]
                    ],
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'max' => 4
                        ]
                    ]
                ],
            ],
        ];
    }
}
