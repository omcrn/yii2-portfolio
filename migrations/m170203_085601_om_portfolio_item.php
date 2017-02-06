<?php

use yii\db\Migration;

class m170203_085601_om_portfolio_item extends Migration
{
    public function up()
    {
        $this->createTable('{{%om_portfolio_item}}',[
            'id' => $this->primaryKey(),
            'slug' => $this->string(1024)->notNull(),
            'thumbnail' => $this->string(255)->notNull(),
            'start_date' => $this->dateTime()->null(),
            'end_date' => $this->dateTime()->null(),
            'sort_order' => $this->integer(2)->notNull()->defaultValue(0),
            'created_at' => $this->integer(11)->null(),
            'updated_at' => $this->integer(11)->null()
        ]);
        $this->createIndex(
            'idx_portfolio_item',
            '{{%om_portfolio_item}}',
            'id',
            true
        );
    }

    public function down()
    {
        $this->dropIndex('idx_portfolio_item','{{%om_portfolio_item}}');
        $this->dropTable('{{%om_portfolio_item}}');
    }
}
