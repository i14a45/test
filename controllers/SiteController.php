<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\CalcForm;

class SiteController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new CalcForm();
        $model->start = 1500;
        $model->end = 4200;

        if ($model->load(Yii::$app->request->post())) {
            $model->calc();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
