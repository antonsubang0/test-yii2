<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class Employer extends ActiveRecord
{
    public $verifyCode;

    public static function tableName()
    {
        return 'employer';
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['first_name', 'last_name', 'email'], 'required'],
            [['id_company'], 'integer'],
            [['first_name', 'last_name', 'email', 'phone'], 'string', 'max' => 255],
            // email has to be a valid email address
            [['email'], 'unique'],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['id_company' => 'id_company']],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'id_company' => 'Company',
            'email' => 'Email',
            'phone' => 'Phone',
        ];
    }
    public function getCompany()
    {
        return $this->hasOne(Companies::class, ['id_company' => 'id_company']);
    }
}
