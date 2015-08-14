<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\config\controllers;

use yii\web\Controller;
use jlorente\config\models\Variable;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Controller to handle the requests of the crud operations of the Variable 
 * model.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
class VariableController extends Controller {

    /**
     * Renders the create form and create a Variable model.
     * 
     * @return type
     */
    public function actionIndex() {
        $model = $this->getModel();
        $model->load(Yii::$app->request->get());
        return $this->render('index', ['model' => $model]);
    }

    /**
     * Renders the view of a Variable model.
     * 
     * @param type $id
     * @return \yii\web\Response
     */
    public function actionView($id) {
        return $this->render('view', ['model' => $this->getModel($id)]);
    }

    /**
     * Renders the update form and updates a Variable model.
     * 
     * @param type $id
     * @return \yii\web\Response
     */
    public function actionUpdate($id) {
        $model = $this->getModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    /**
     * Returns a Variable model instance.
     * 
     * @param int $id
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function getModel($id = null) {
        $class = Variable::className();
        if ($id === null) {
            $m = new $class();
        } else {
            $m = $class::findOne($id);
            if ($m === null) {
                throw new NotFoundHttpException();
            }
        }
        return $m;
    }

}
