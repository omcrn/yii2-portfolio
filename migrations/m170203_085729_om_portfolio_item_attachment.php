<?php

use yii\db\Migration;

class m170203_085729_om_portfolio_item_attachment extends Migration
{
    public function up()
    {
        $this->createTable('{{%om_portfolio_item_attachment}}',[
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'path' => $this->string(512)->notNull(),
            'mime' => $this->string(15)->notNull(),
            'status' => $this->smallInteger(1)->null(),
            'created_at' => $this->integer(11)->null(),
            'updated_at' => $this->integer(11)->null()
        ]);
        $this->addForeignKey(
            'fk_item_attachment',
            '{{%om_portfolio_item_attachment}}',
            'item_id',
            'om_portfolio_item',
            'id',
            'NO ACTION'
        );
        $this->createIndex(
            'idx_portfolio_item_attachment_id',
            '{{%om_portfolio_item_attachment}}',
            'id',
            true
        );
        $this->createIndex(
            'idx_portfolio_item_attachment_item_id',
            '{{%om_portfolio_item_attachment}}',
            'item_id',
            false
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_item_attachment','{{%om_portfolio_item_attachment}}');
        $this->dropIndex('idx_portfolio_item_attachment_id','{{%om_portfolio_item_attachment}}');
        $this->dropIndex('idx_portfolio_item_attachment_item_id','{{%om_portfolio_item_attachment}}');
        $this->dropTable('{{%om_portfolio_item_attachment}}');
    }
}
