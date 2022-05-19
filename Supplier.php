<?php

namespace app\module\admin\models;

use app\components\helper\Tree;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "linkage".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parentid
 * @property integer $keyid
 * @property integer $listorder
 */
class Supplier extends \app\module\admin\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('adminDb');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name','code','t_status'], 'required'],
            [['name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            't_status' => 'T_status',
        ];
    }
}
