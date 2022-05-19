<?php

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\Supplier;
use app\module\admin\models\search\SupplierSearch;
use app\module\admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\helper\TheCsv;

/**
 * PartnerController implements the CRUD actions for Partner model.
 */
class SupplierController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    /**
     * Lists all Partner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SupplierSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    /**
     * export
     * @param
     * @return mixed
     */
    public function actionExport()
    {
        $query = Supplier::find();
        $data = Yii::$app->request->getQueryParams();
        $query->andFilterWhere([
            't_status' => $data['t_status'],
        ]);
        if(!empty($data['id'])){
            $query->andFilterWhere([
                    $data['id'], 'id', 10]
            );
        }
        $query->andFilterWhere(['like', 'name', $data['name']])
            ->andFilterWhere(['like', 'code', $data['code']]);
        if(Yii::$app->request->isAjax){
            $num = $query->count();
            echo $num;die();
        }
        $return = $query->asArray()->all();
        TheCsv::export([
            'reader' => $return,
        ]);
    }
    /**
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
