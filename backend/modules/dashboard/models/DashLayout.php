<?php

namespace app\modules\dashboard\models;
use app\modules\dashboard\models\DashCell;

use Yii;

/**
 * This is the model class for table "dash_layout".
 *
 * @property int $id
 * @property string $name
 */
class DashLayout extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dash_layout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getCells()
    {
        return $this->hasMany(DashCell::className(), ['layout_id' => 'id'])
            ->orderBy('order');
    }

    public static function getAllLayouts()
    {
        return self::find()
            ->select(['name','id'])
            ->indexBy('id')
            ->column();
    }
}
