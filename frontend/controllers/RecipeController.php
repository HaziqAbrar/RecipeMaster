<?php


namespace frontend\controllers;

use common\models\Recipe;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;




class RecipeController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Recipe::find()->published()->latest()
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $recipe = Recipe::findOne($id);
        if (!$recipe) {
            throw new NotFoundHttpException("Recipe does not exist.");
        }

        return $this->render('view', [
            'model' => $recipe
        ]);
    }
}
