<?php

use yii\db\Migration;

class m170203_085554_om_portfolio_category_translation extends Migration
{
    public function up()
    {
        $this->createTable('{{%om_portfolio_category_translation}}',[
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->notNull(),
            'locale' => $this->string(10)->notNull(),
            'slug' => $this->string(256)->notNull(),
            'name' => $this->string(256),
        ]);

        $this->addForeignKey('fk_category_translation', '{{%om_portfolio_category_translation}}', 'category_id',
                            '{{%om_portfolio_category}}', 'id', 'CASCADE', 'NO ACTION');

        $this->createIndex('idx_portfolio_category_translation_id', '{{%om_portfolio_category_translation}}', 'id', true);
        $this->createIndex('idx_portfolio_category_translation_category_id', '{{%om_portfolio_category_translation}}', 'category_id', false);
    }

    public function down()
    {
        $this->dropIndex('idx_portfolio_category_translation_category_id','{{%om_portfolio_category_translation}}');
        $this->dropIndex('idx_portfolio_category_translation_id','{{%om_portfolio_category_translation}}');
        $this->dropForeignKey('fk_category_translation', '{{%om_portfolio_category_translation}}');
        $this->dropTable('{{%om_portfolio_category_translation}}');
    }
}
