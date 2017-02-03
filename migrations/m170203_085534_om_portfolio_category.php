<?php

use yii\db\Migration;

class m170203_085534_om_portfolio_category extends Migration
{
    public function up()
    {
        $this->createTable('{{%om_portfolio_category}}',[
            'id' => $this->primaryKey(),
            'slug' => $this->string(1024)->notNull(),
            'name' => $this->string(45),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'created_at' => $this->integer(11)->null(),
            'updated_at' => $this->integer(11)->null()
        ]);
        $this->createIndex(
            'idx_portfolio_category',
            '{{%om_portfolio_category}}',
            'id',
            true
        );
    }

    public function down()
    {
        $this->dropIndex('idx_portfolio_category','{{%om_portfolio_category}}');
        $this->dropTable('{{%om_portfolio_category}}');
    }
}
