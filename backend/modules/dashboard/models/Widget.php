<?php

namespace app\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "widget".
 *
 * @property string $widget_id
 * @property string $name
 * @property string $class
 */
class Widget extends \common\components\Model
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'class'], 'string', 'max' => 255],
            [['class'], 'validateClass'],
            [['name', 'class'], 'trim']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'widget_id' => Yii::t('dashboard.global', 'Widget ID'),
            'name' => Yii::t('dashboard.global', 'Name'),
            'class' => Yii::t('dashboard.global', 'Class'),
        ];
    }

    public function validateClass($attribute, $params)
    {
        if ($this->hasErrors($attribute)) {
            return false;
        }

        if (!$this->_classExists($this->$attribute)) {
            $this->addError($attribute, "Class '{$this->{$attribute}}' does not exist or has syntax error.");
            return false;
        }

        $reflectionClass = new \ReflectionClass($this->$attribute);

        if (($reflectionClass->hasMethod('__call')) || ($reflectionClass->hasMethod('__callStatic'))) {
            return true; // magic method will always be called if a method can't be
        }

        return true;
    }

    protected function _classExists($className)
    {
        return class_exists($className) && in_array($className, get_declared_classes());
    }
}