<?php

namespace app\module\admin\models\search;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\admin\models\Supplier;
/**
 * PartnerSearch represents the model behind the search form about `app\module\admin\models\Partner`.
 */
class SupplierSearch extends Supplier
{
    public function rules()
    {
        return [
            [['id','name', 'code','t_status'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Supplier::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>10
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            't_status' => $this->t_status,
        ]);
        if(!empty($this->id)){
            $query->andFilterWhere([
                $this->id, 'id', 10]
            );
        }
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
