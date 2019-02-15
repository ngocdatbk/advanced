<?php

namespace app\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "dashboard".
 *
 * @property int $id
 * @property int $user_id
 * @property int $cell_id
 * @property int $widget_id
 * @property int $order
 * @property int $project_id
 */
class Dashboard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dashboard';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'cell_id', 'widget_id', 'order', 'project_id'], 'required'],
            [['user_id', 'cell_id', 'widget_id', 'order', 'project_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'cell_id' => 'Cell ID',
            'widget_id' => 'Widget ID',
            'order' => 'Order',
            'project_id' => 'Project ID',
        ];
    }

    public static function getWidgets($project_id)
    {
        return self::find()
            ->innerJoin('widget',['id' => 'widget_id'])
            ->select(['widget.name','widget.id'])
            ->where(['user_id' => Yii::$app->user->id, 'project_id' => $project_id])
            ->all();
    }
}
