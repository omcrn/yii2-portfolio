<?php

use yii\db\Migration;

class m170203_085754_om_portfolio_item_attachment_translation extends Migration
{
    public function up()
    {
        $this->createTable('{{%om_portfolio_item_attachment_translation}}',[
            'id' => $this->primaryKey(),
            'item_attachment_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->null(),
            'description' => $this->text()->null()
        ]);
        $this->addForeignKey(
            'fk_attachment_translation',
            '{{%om_portfolio_item_attachment_translation}}',
            'item_attachment_id',
            'om_portfolio_item_attachment',
            'id',
            'NO ACTION'
        );
        $this->createIndex(
            'idx_portfolio_item_attachment_translation_id',
            '{{%om_portfolio_item_attachment_translation}}',
            'id',
            true
        );
        $this->createIndex(
            'idx_portfolio_item_attachment_translation_attachment_id',
            '{{%om_portfolio_item_attachment_translation}}',
            'item_attachment_id',
            false
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_attachment_translation','{{%om_portfolio_item_attachment_translation}}');
        $this->dropIndex('idx_portfolio_item_attachment_translation_id','{{%om_portfolio_item_attachment_translation}}');
        $this->dropIndex('idx_portfolio_item_attachment_translation_attachment_id','{{%om_portfolio_item_attachment_translation}}');
        $this->dropTable('{{%om_portfolio_item_attachment_translation}}');
    }
}
