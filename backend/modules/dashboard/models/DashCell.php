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
            [['name', 'layout_id', 'order', 'span'], 'required'],
            [['layout_id', 'order', 'span'], 'integer'],
            [['name'], 'string', 'max' => 255],
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

    public function getWidgets($project_id)
    {
        return $this->find()
            ->select(['widget.name', 'widget.widget_id', 'dashboard.id as dasboard_id'])
            ->innerJoin('dashboard', 'dashboard.cell_id = dash_cell.id')
            ->innerJoin('widget', 'widget.widget_id = dashboard.widget_id')
        ->where([
            'dash_cell.id' => $this->id,
            'dashboard.user_id' => Yii::$app->user->id,
            'dashboard.project_id' => $project_id,
        ])->asArray()->all();
    }
}
