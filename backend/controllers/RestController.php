<?php
namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

class RestController extends BaseController
{
  public $modelClass = 'app\models\Rest';

  public function behaviors()
  {
    return ArrayHelper::merge(parent::behaviors(), [
      'authenticator' => [
        'class' => CompositeAuth::className(),
        'authMethods' => [
          HttpBasicAuth::className(),
          HttpBearerAuth::className(),
          QueryParamAuth::className(),
        ],
      ],
    ]);
  }

  public function actionIndex()
  {
      $modelClass = $this->modelClass;
      $query = $modelClass::find(); // equivalent to $query = EntryForm::find()
      return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
  }

  public function actionCreate()
  {
      $model = new Product;
      $model->attributes = Yii::$app->request->post();
      if (!$model->save()) {
          return array_values($model->getFirstErrors())[0];
      }
      return $model;
  }

  public function actionView($id)
  {
      $model = $this->findModel($id);
      if ($model === null) {
          throw new NotFoundHttpException('Can not find this object!');
      } else {
          return $model;
      }
  }

  public function actionUpdate($id)
  {
      $model = $this->findModel($id);
      if ($model === null) {
          throw new NotFoundHttpException('Can not find this object!');
      } else {
          $model->attributes = Yii::$app->request->post();
          if (!$model->save()) {
              return array_values($model->getFirstErrors())[0];
          }
          return $model;
      }
  }

  public function actionDelete($id)
  {
      $model = $this->findModel($id);
      // Delete in physical
      if($model) {
        $model->delete();
        $modelClass = $this->modelClass;
        $query = $modelClass::find(); // equivalent to $query = EntryForm::find()
        return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
      }
      // Delete in logical
      // $model->isDeleted = true;
      // $model->save();
      return null;
  }

  private function findModel($id)
  {
      return Product::findOne(['id' => $id]);
  }
}
