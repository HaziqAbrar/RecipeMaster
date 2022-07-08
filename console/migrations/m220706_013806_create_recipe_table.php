<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recipe}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m220706_013806_create_recipe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%recipe}}', [
            'recipe_id' => $this->string(16)->notNull(),
            'name' => $this->string(512)->notNull(),
            'description' => $this->text(),
            'tags' => $this->string(512),
            'average_cost' => $this->integer(11),
            'status' => $this->integer(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
        ]);

        $this->addPrimaryKey('PK_recipe_recipe_id','{{%recipe}}','recipe_id');

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-recipe-created_by}}',
            '{{%recipe}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-recipe-created_by}}',
            '{{%recipe}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-recipe-created_by}}',
            '{{%recipe}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-recipe-created_by}}',
            '{{%recipe}}'
        );

        $this->dropTable('{{%recipe}}');
    }
}
