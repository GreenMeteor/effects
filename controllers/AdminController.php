<?php

namespace gm\humhub\modules\effects\controllers;

use Yii;
use gm\humhub\modules\effects\Module;
use humhub\modules\admin\components\Controller;
/**
 * @property Module $module
 */
class AdminController extends Controller
{
    public function actionIndex()
    {
        $model = $this->module->getConfiguration();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->view->saved();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
