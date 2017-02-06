<?php

use yii\db\Migration;

class m170203_085710_om_portfolio_item_translation extends Migration
{
    public function up()
    {
        $this->createTable('{{%om_portfolio_item_translation}}',[
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'locale' => $this->string(10)->notNull(),
            'title' => $this->string(255)->notNull(),
            'short_description' => $this->string(512)->notNull(),
            'description' => $this->text()->null(),
            'keywords' => $this->string(255)->null(),
            'meta_title' => $this->string(512)->null(),
            'meta_description' => $this->string(512)->null(),
            'meta_keywords' => $this->string(512)->null()
        ]);
        $this->addForeignKey(
            'fk_item_translation',
            '{{%om_portfolio_item_translation}}',
            'item_id',
            'om_portfolio_item',
            'id',
            'NO ACTION'
        );
        $this->createIndex(
            'idx_portfolio_item_translation_id',
            '{{%om_portfolio_item_translation}}',
            'id',
            true
        );
        $this->createIndex(
            'idx_portfolio_item_translation_item_id',
            '{{%om_portfolio_item_translation}}',
            'item_id',
            false
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_item_translation','{{%om_portfolio_item_translation}}');
        $this->dropIndex('idx_portfolio_item_translation_id','{{%om_portfolio_item_translation}}');
        $this->dropIndex('idx_portfolio_item_translation_item_id','{{%om_portfolio_item_translation}}');
        $this->dropTable('{{%om_portfolio_item_translation}}');
    }
}
