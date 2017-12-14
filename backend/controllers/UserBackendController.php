<?php

namespace backend\controllers;

use backend\models\SignupForm;
use Yii;
use backend\models\UserBackend;
use backend\models\UserBackendSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\db\Query;
/**
 * UserBackendController implements the CRUD actions for UserBackend model.
 */
class UserBackendController extends Controller
{
    public $adminlist;
   public  function  init()
   {
       $condition[] = 'and';
       $condition[] = ['=', 'type', 1];
       $query = new Query;
       $admin = $query
           ->select([
               'name',
           ])
           ->from('w_auth_item')
           ->where($condition)
           ->all();
       $adminall=array();
       foreach ($admin as &$key){
           $adminall[$key['name']]=$key['name'];
       }
      $this->adminlist=$adminall;
   }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserBackend models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new UserBackendSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /*用户注册*/
    public function actionSignup ()
    {


        // 实例化一个表单模型，这个表单模型我们还没有创建，等一下后面再创建
        $model=new SignupForm();
        $request = YII::$app->request;

        if( $request->isPost && $model->load(Yii::$app->request->post()) && $model->changePassword()){
            Yii::$app->user->logout();
            return $this->goHome();
        }else{
           return $this->render('signup',['model'=>$model]);
        }




    }
    /**
     * Displays a single UserBackend model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserBackend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserBackend();

        if (!empty(Yii::$app->request->post()) ) {
            $userpost =Yii::$app->request->post();
            $userpost['UserBackend']['password'] = $model->updatePassword($userpost['UserBackend']['password']);
            if($model->load($userpost) && $model->save() ){
                return $this->redirect(Url::toRoute('index'));
            }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserBackend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

            if(Yii::$app->request->post() && $model->load(Yii::$app->request->post()) && $model->save() ){
                return $this->redirect(Url::toRoute('index'));
            }
            else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionPassword($id)
    {
        $model = $this->findModel($id);
        if (!empty(Yii::$app->request->post()) ) {
            $userpost =Yii::$app->request->post();
            if(empty($userpost['UserBackend']['password'])){
                $userpost['UserBackend']['password'] = $model->password;
            }else{
                $userpost['UserBackend']['password'] = $model->updatePassword($userpost['UserBackend']['password']);
            }
            if($model->load($userpost) && $model->save() ){
                return $this->redirect(Url::toRoute('index'));
            }
        } else {
            return $this->renderAjax('password', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing UserBackend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->db->createCommand()->delete('w_auth_assignment', 'user_id ='.$id)->execute();
        return $this->redirect(['index']);
    }

    /**
     * Finds the UserBackend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserBackend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserBackend::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
