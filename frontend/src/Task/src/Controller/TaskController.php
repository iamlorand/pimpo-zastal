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
 * @method TemplatePlugin|string template(string $template = null, array $params = [])
 * @method AuthenticationPlugin authentication()
 * @method AuthorizationPlugin isGranted(string $permission, array $roles = [], mixed $context = null)
 *
 * @Service
 */
class TaskController extends AbstractActionController
{
    /** @var TaskServiceInterface */
    protected $taskService;

    /**
     * PostController constructor.
     * @param TaskServiceInterface $taskService
     *
     * @Inject({TaskServiceInterface::class})
     */
    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        return new HtmlResponse('Hello this is Very task!');
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
        $template['pageTitle'] = 'Add new task';
        $template['form'] = $this->forms('TaskForm');
        return new HtmlResponse($this->template('task::add', $template));
    }
}
