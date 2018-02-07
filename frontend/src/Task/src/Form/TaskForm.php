<?php
/**
 * @see https://github.com/dotkernel/frontend/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/frontend/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace Frontend\Task\Form;

use Zend\Form\Form;

/**
 * Class TaskForm
 * @package Frontend\Task\Form
 */
class TaskForm extends Form
{
    /** @var  array */
    protected $recaptchaOptions;

    /**
     * TaskForm constructor.
     * @param string $name
     * @param array $options
     */
    public function __construct($name = 'taskForm', array $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->add([
            'type' => 'TaskFieldset',
            'options' => [
                'use_as_base_fieldset' => true,
            ]
        ]);

        $this->add([
            'type' => 'Csrf',
            'name' => 'contact_csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 3600,
                    'message' => 'The form used to make the request has expired and was refreshed. Please try again.'
                ]
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Add task'
            ]
        ], ['priority' => -105]);
    }
}
