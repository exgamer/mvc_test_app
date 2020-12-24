<?php

namespace Controllers;

use Core\Base\Controller;
use Core\Db\Mysql\Read\QueryBuilder;
use Core\Validators\EmailValidator;
use Models\Task;
use Models\User;
use ReflectionException;
use Services\TaskService;

/**
 * Class SiteController
 * @package Controllers
 * @author citizenzet <exgamer@live.ru>
 */
class SiteController extends Controller
{
    /**
     * Возвращает сервис задач
     *
     * @return TaskService
     * @throws ReflectionException
     */
    protected function taskService()
    {
        return $this->getApp()->get('taskService');
    }

    public function actionLogin()
    {
        $model = new User();
        if ($post = $this->getApp()->getRequest()->getPost()) {
            $model->loadData($post);
            if ($model->validate() && $model->login()) {

                return $this->redirect('index');
            }
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        $this->getApp()->getUser()->logout();
        return $this->redirect('index');
    }


    public function actionIndex($page = 0)
    {
        // к этому моменту я уже очень устал и сортировка сделана по простому
        $params = $this->getApp()->getRequest()->getQueryParams();
        $orderBy['id'] = 'DESC';
        if (isset($params['username']) && in_array($params['username'], ["ASC", "DESC"])) {
            $orderBy['username'] = $params['username'];
        }

        if (isset($params['email']) && in_array($params['email'], ["ASC", "DESC"])) {
            $orderBy['email'] = $params['email'];
        }

        if (isset($params['done']) && in_array($params['done'], ["ASC", "DESC"])) {
            $orderBy['done'] = $params['done'];
        }

        $models = $this->taskService()->allByCondition( function(QueryBuilder $builder) use ($page, $orderBy){
            $builder->calculateRowsCount();
            $builder->limit(10);
            $builder->offset($page*10);
            foreach ($orderBy as $field => $v){
                $builder->order($field . " " .$v);
            }
        });

        $totalCount = $this->taskService()->getCount();
        $pageCount = ceil($totalCount/10);

        return $this->render('index', [
            'models' => $models,
            'page' => $page,
            'user' => $this->getApp()->getUser(),
            'pageCount' => $pageCount,
            'orderBy' => $orderBy,
        ]);
    }

    public function actionCreate()
    {
        $model = new Task();
        if ($post = $this->getApp()->getRequest()->getPost()) {
            $model->loadData($post);
            if ($model->validate() && $this->taskService()->persist($model->getValidData())) {

                return $this->redirect('index');
            }
        }

        return $this->render('form', ['model' => $model, 'title' => 'Добавить задачу', 'user' => $this->getApp()->getUser()]);
    }

    public function actionUpdate($id)
    {
        $row = $this->taskService()->oneById( $id);
        if (! $row) {
            throw new \Exception("Not found");
        }

        $model = new Task();
        $model->loadData($row);
        if ($post = $this->getApp()->getRequest()->getPost()) {
            if (! isset($post['done'])) {
                $post['done'] = 0;
            }

            $model->loadData($post);
            if ($model->validate() && $this->taskService()->update($model->getValidData(), ['id' => $id])) {

                return $this->redirect('index');
            }
        }

        return $this->render('form', ['model' => $model, 'title' => 'Редактировать задачу', 'user' => $this->getApp()->getUser()]);
    }
}