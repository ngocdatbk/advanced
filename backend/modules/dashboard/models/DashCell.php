<?php

namespace app\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "dash_cell".
 *
 * @property int $id
 * @property string $name
 * @property int $layout_id
 * @property int $order
 * @property int $span
 */
class DashCell extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dash_cell';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'layout_id', 'order', 'span'], 'required'],
            [['id', 'layout_id', 'order', 'span'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
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
            'layout_id' => 'Layout ID',
            'order' => 'Order',
            'span' => 'Span',
        ];
    }
}
