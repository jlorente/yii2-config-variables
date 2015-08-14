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
     * Renders the create form and create a Variable model.
     * 
     * @return type
     */
    public function actionCreate() {
        $model = $this->getModel();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['read', 'id' => $model->primaryKey()]);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Renders the view of a Variable model.
     * 
     * @param type $id
     * @return \yii\web\Response
     */
    public function actionRead($id) {
        return $this->render('create', ['model' => $this->getModel($id)]);
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
            return $this->redirect(['read', 'id' => $id]);
        }
        return $this->render('create');
    }

    /**
     * Deletes a Variable model.
     * 
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionDelete($id) {
        $model = $this->getModel($id);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('jlorente/config', 'Model with id [' . $id . '] deleted.'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('jlorente/config', 'Unable to delete model with id [' . $id . '].'));
        }
        return $this->redirect(['index']);
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
