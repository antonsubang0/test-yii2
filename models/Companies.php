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
            [['name_company', 'email_company'], 'required'],
            [['website_company'], 'safe'],
            [['logo_company'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
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
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */

    public function upload()
    {
        if ($this->validate()) {
            $patch = 'uploads/' . $this->logo_company->baseName . '.' . $this->logo_company->extension;
            $this->logo_company->saveAs($patch);
        } else {
            return false;
        }
    }
}
