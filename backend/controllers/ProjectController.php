<?php

namespace backend\controllers;

use Yii;
use backend\models\ProjectList;
use backend\models\SearchProjectInfo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectController implements the CRUD actions for ProjectList model.
 */
class ProjectController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors ()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'POST' ],
                ],
            ],
        ];
    }

    /**
     * Lists all ProjectList models.
     * @return mixed
     */
    public function actionIndex ()
    {
        $searchModel = new SearchProjectInfo();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );

        return $this->render( 'index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single ProjectList model.
     * @param integer $id
     * @return mixed
     */
    public function actionView ( $id )
    {
        return $this->render( 'view', [
                'model' => $this->findModel( $id ),
            ]
        );
    }

    /**
     * Creates a new ProjectList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate ()
    {
        if ( Yii::$app->request->isPost )
        {
            $postData = Yii::$app->request->post();
            $postData['ProjectList']['add_time'] = date( 'Y-m-d H:i:s' );
            Yii::$app->request->setBodyParams( $postData );
        }
        $model = new ProjectList();
        if ( $model->load( Yii::$app->request->post(), 'ProjectList' ) && $model->save() )
        {
            return $this->redirect( [ 'view', 'id' => $model->id ] );
        }
        else
        {
            return $this->render( 'create', [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Updates an existing ProjectList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate ( $id )
    {
        $model = $this->findModel( $id );

        if ( $model->load( Yii::$app->request->post() ) && $model->save() )
        {
            return $this->redirect( [ 'view', 'id' => $model->id ] );
        }
        else
        {
            return $this->render( 'update', [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * Deletes an existing ProjectList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete ( $id )
    {
        $this->findModel( $id )->delete();

        return $this->redirect( [ 'index' ] );
    }

    /**
     * Finds the ProjectList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel ( $id )
    {
        if ( ( $model = ProjectList::findOne( $id ) ) !== null )
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}
