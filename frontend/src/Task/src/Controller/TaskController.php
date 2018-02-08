<?php
/**
 * @see https://github.com/dotkernel/frontend/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/frontend/blob/master/LICENSE.md MIT License
 */

namespace Frontend\Task\Controller;

use Dot\AnnotatedServices\Annotation\Service;
use Dot\AnnotatedServices\Annotation\Inject;
use Dot\Controller\AbstractActionController;
use Dot\Controller\Plugin\Authentication\AuthenticationPlugin;
use Dot\Controller\Plugin\Authorization\AuthorizationPlugin;
use Dot\Controller\Plugin\FlashMessenger\FlashMessengerPlugin;
use Dot\Controller\Plugin\Forms\FormsPlugin;
use Dot\Controller\Plugin\TemplatePlugin;
use Dot\Controller\Plugin\UrlHelperPlugin;
use Dot\Hydrator\ClassMethodsCamelCase;
use Fig\Http\Message\RequestMethodInterface;
use Frontend\Task\Entity\TaskEntity;
use Frontend\Task\Service\CategoryServiceInterface;
use Frontend\Task\Service\TaskServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Form\Form;

/**
 * Class TaskController
 * @package Frontend\Task\Controller
 *
 * @method UrlHelperPlugin|UriInterface url(string $route = null, array $params = [])
 * @method FlashMessengerPlugin messenger()
 * @method FormsPlugin|Form forms(string $name = null)
 * @method TemplatePlugin|string template(string $data = null, array $params = [])
 * @method AuthenticationPlugin authentication()
 * @method AuthorizationPlugin isGranted(string $permission, array $roles = [], mixed $context = null)
 *
 * @Service
 */
class TaskController extends AbstractActionController
{
    /** @var TaskServiceInterface */
    protected $taskService;

    /** @var  CategoryServiceInterface */
    protected $categoryService;
    /**
     * PostController constructor.
     * @param TaskServiceInterface $taskService
     * @param CategoryServiceInterface $categoryService
     *
     * @Inject({TaskServiceInterface::class, CategoryServiceInterface::class})
     */
    public function __construct(TaskServiceInterface $taskService, CategoryServiceInterface $categoryService)
    {
        $this->taskService = $taskService;
        $this->categoryService = $categoryService;
    }

    /**
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        return new RedirectResponse($this->url('task', ['action' => 'list']));
    }

    /**
     * @return ResponseInterface
     */
    public function addAction(): ResponseInterface
    {
        if ($this->request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $formData = $this->request->getParsedBody();
            $taskObj = new TaskEntity();
            $hydrator = new ClassMethodsCamelCase();
            $hydrator->hydrate($formData['taskForm'], $taskObj);

            if ($this->taskService->addTask($taskObj) !== false) {
                return new RedirectResponse($this->url('task', ['action' => null]));
            }
        }

        $categoryList = $this->categoryService->listCategory();
        $taskForm = $this->forms('TaskForm');
        $categoryIdField = $taskForm->getBaseFieldset()->get('categoryId');

        $categoryDataList = [];
        foreach ($categoryList as $category) {
            $categoryDataList[$category->getId()] = $category->getTitle();
        }

        $categoryIdField->setOptions(['value_options' => $categoryDataList]);

        $data['pageTitle'] = 'Add new task';
        $data['form'] = $taskForm;
        return new HtmlResponse($this->template('task::add', $data));
    }

    /**
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
//        $dateLike = date('o-m') . '%';
//        $options['conditions'] = [
//            "date LIKE '$dateLike'"
//        ];

        $data['taskList'] = $this->taskService->listTask();
//        $data['taskList'] = $this->taskService->listTaskByDate($options);
        $data['pageTitle'] = 'Task list';

        return new HtmlResponse($this->template('task::list', $data));
    }

    /**
     * @return ResponseInterface
     */
    public function updateAction(): ResponseInterface
    {
        $taskId = $this->request->getAttribute('id');
        $hydrator = new ClassMethodsCamelCase();
        $updateObj = $this->taskService->getTask($taskId);

        if ($this->request->getMethod() === RequestMethodInterface::METHOD_POST) {
            $formData = $this->request->getParsedBody();
            $formData['taskForm']['id'] = $taskId;
            $hydrator->hydrate($formData['taskForm'], $updateObj);

            if ($this->taskService->updateTask($updateObj) !== false) {
                return new RedirectResponse($this->url('task', ['action' => null]));
            }
        }

        $categoryList = $this->categoryService->listCategory();



        $updateData['taskForm'] = $hydrator->extract($updateObj);
        $updateForm = $this->forms('TaskForm');
        $updateForm->setData($updateData);

        $categoryIdField = $updateForm->getBaseFieldset()->get('categoryId');
        $categoryDataList = [];
        foreach ($categoryList as $category) {
            $categoryDataList[$category->getId()] = $category->getTitle();
        }
        $categoryIdField->setOptions(['value_options' => $categoryDataList]);

        $data['pageTitle'] = 'Edit task';
        $data['form'] = $updateForm;

        return new HtmlResponse($this->template('task::add', $data));
    }

    /**
     * @return ResponseInterface
     */
    public function deleteAction(): ResponseInterface
    {
        $data['pageTitle'] = 'Delete confirmation';
        $taskId = $this->request->getAttribute('id');
        $deleteObj = $this->taskService->getTask($taskId);

        if ($this->request->getMethod() === RequestMethodInterface::METHOD_POST && $deleteObj !== null) {
            if ($this->taskService->deleteTask($deleteObj)) {
                return new RedirectResponse($this->url('task', ['action' => null]));
            }
        }

        return new HtmlResponse($this->template('task::delete', $data));
    }
}
