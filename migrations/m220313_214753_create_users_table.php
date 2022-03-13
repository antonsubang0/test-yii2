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
            'id_user' => $this->primaryKey(),
            'nama_user' => $this->string()->notNull(),
            'email_user' => $this->string()->notNull()->unique(),
            'password_user' => $this->string(),
            'authKey' => $this->string(),
            'accessToken' => $this->string(),
            'role' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
