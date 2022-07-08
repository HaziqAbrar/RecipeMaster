<?php

namespace backend\controllers;

use common\models\Recipe;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\VarDumper;
use Yii;
use yii\filters\AccessControl;

/**
 * RecipeController implements the CRUD actions for Recipe model.
 */
class RecipeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ]
                    ]
                ]
            ],
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ],
        );
    }

    /**
     * Lists all Recipe models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Recipe::find()
                                ->creator(Yii::$app->user->id)
                                ->latest()
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'recipe_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Recipe model.
     * @param string $recipe_id Recipe ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($recipe_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($recipe_id),
        ]);
    }

    /**
     * Creates a new Recipe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Recipe();

        $model->recipe = UploadedFile::getInstanceByName('recipe');

        // VarDumper::dump($model);

        
        if ($this->request->isPost) {
            if (Yii::$app->request->isPost && $model->save()) {
                return $this->redirect(['update', 'recipe_id' => $model->recipe_id]);
            }
            
            // echo '<pre>';
            // var_dump($model->load($this->request->post()));
            // echo '</pre>';
            // exit;
            // VarDumper::dump( $model->errors);

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Recipe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $recipe_id Recipe ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($recipe_id)
    {
        $model = $this->findModel($recipe_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['update', 'recipe_id' => $model->recipe_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Recipe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $recipe_id Recipe ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($recipe_id)
    {
        $this->findModel($recipe_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Recipe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $recipe_id Recipe ID
     * @return Recipe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($recipe_id)
    {
        if (($model = Recipe::findOne(['recipe_id' => $recipe_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
