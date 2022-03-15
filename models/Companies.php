<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class Companies extends ActiveRecord
{
    public $verifyCode;
    public $file_image;

    public static function tableName()
    {
        return 'companies';
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name_company'], 'required'],
            [['website_company', 'logo_company', 'email_company'], 'safe'],
            [['file_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            // email has to be a valid email address
            ['email_company', 'email'],
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
            'name_company' => 'Name',
            'email_company' => 'Email',
            'logo_company' => 'Logo',
            'website_company' => 'Website',
            'file_image' => 'Upload Logo',
        ];
    }
}
