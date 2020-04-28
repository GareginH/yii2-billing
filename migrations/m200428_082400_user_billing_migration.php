<?php

use yii\db\Migration;

/**
 * Class m200428_082400_user_billing_migration
 */
class m200428_082400_user_billing_migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id'=>$this->primaryKey(),
            'username'=>$this->string(50)->notNull(),
            'password'=>$this->string()->notNull(),
            'authKey'=>$this->string()->notNull(),
            'accessToken'=>$this->string()->notNull(),
        ]);
        $this->createTable('billing',[
            'id'=>$this->primaryKey(),
            'amount'=>$this->double(),
            'user_id'=>$this->integer()
        ]);
        $this->addForeignKey('FK_billing_user', 'billing', 'user_id', 'user', 'id', "CASCADE", "CASCADE");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_billing_user', 'billing');
        $this->dropTable('billing');
        $this->dropTable('user');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200428_082400_user_billing_migration cannot be reverted.\n";

        return false;
    }
    */
}
