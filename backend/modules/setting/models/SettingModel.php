<?php

namespace app\modules\setting\models;

use Yii;
use yii\base\Model;
use app\modules\setting\models\Setting;

class SettingModel extends Model
{
    public $email_shop;
    public $email_pass;
    public $name;
    public $status;
    public $gender;
    public $is_admin;
    public $facebook_pixel;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
            [['email_pass', 'facebook_pixel'], 'string'],
            [['email_shop'], 'email'],
            [['status'], 'integer'],
            [['gender'], 'integer'],
            [['is_admin'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'email_shop' => 'Email shop',
        ];
    }
}
