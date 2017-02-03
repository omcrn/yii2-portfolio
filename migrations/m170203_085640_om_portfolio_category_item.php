<?php

use yii\db\Migration;

class m170203_085640_om_portfolio_category_item extends Migration
{
    public function up()
    {
        $this->createTable('{{%om_portfolio_category_item}}',[
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk_category_id',
            '{{%om_portfolio_category_item}}',
            'category_id',
            'om_portfolio_category',
            'id',
            'NO ACTION'
        );
        //Add foreign key to m-t-m connection to table item
        $this->addForeignKey(
            'fk_item_id',
            '{{%om_portfolio_category_item}}',
            'item_id',
            'om_portfolio_item',
            'id',
            'NO ACTION'
        );
        $this->createIndex(
            'idx_portfolio_category_category',
            '{{%om_portfolio_category_item}}',
            'category_id',
            false
        );
        $this->createIndex(
            'idx_portfolio_item_item',
            '{{%om_portfolio_category_item}}',
            'item_id',
            false
        );
        $this->createIndex(
            'idx_portfolio_category_item_id',
            '{{%om_portfolio_category_item}}',
            'id',
            true
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_item_id','{{%om_portfolio_category_item}}');
        $this->dropForeignKey('fk_category_id','{{%om_portfolio_category_item}}');
        $this->dropIndex('idx_portfolio_category_category','{{%om_portfolio_category_item}}');
        $this->dropIndex('idx_portfolio_item_item','{{%om_portfolio_category_item}}');
        $this->dropIndex('idx_portfolio_category_item_id','{{%om_portfolio_category_item}}');
        $this->dropTable('{{%om_portfolio_category_item}}');
    }
}
