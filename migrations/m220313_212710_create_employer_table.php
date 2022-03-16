<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employer}}`.
 */
class m220313_212710_create_employer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employer}}', [
            'id_employer' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'id_company' => $this->integer(),
            'email' => $this->string()->notNull()->unique(),
            'phone' => $this->string(),
            'join_date' => $this->date(),
        ]);
        $this->addForeignKey(
            'fk_companies',
            'employer',
            'id_company',
            'companies',
            'id_company',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_companies',
            'employer',
        );
        $this->dropTable('{{%employer}}');
    }
}
