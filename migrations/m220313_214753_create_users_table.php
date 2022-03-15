<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m220313_214753_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string(),
            'authKey' => $this->string(),
            'accessToken' => $this->string(),
            'role' => $this->integer(),
        ]);
        $this->insert('users', array(
            'username' => 'admin@admin.com',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('password'),
            'authKey' => 'test100key',
            'accessToken' => '100-token',
            'role' => 20
        ));
        $this->insert('users', array(
            'username' => 'user@user.com',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('password'),
            'authKey' => 'test101key',
            'accessToken' => '101-token',
            'role' => 10
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
