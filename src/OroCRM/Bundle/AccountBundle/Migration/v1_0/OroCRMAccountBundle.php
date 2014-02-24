<?php

namespace OroCRM\Bundle\AccountBundle\Migration\v1_0;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\InstallerBundle\Migrations\Migration;

class OroCRMAccountBundle implements Migration
{
    /**
     * @inheritdoc
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function up(Schema $schema)
    {
        // @codingStandardsIgnoreStart

        /** Generate table orocrm_account **/
        $table = $schema->createTable('orocrm_account');
        $table->addColumn('id', 'integer', ['default' => null, 'notnull' => true, 'length' => null, 'precision' => 10, 'scale' => 0, 'fixed' => false, 'unsigned' => false, 'autoincrement' => true, 'comment' => '']);
        $table->addColumn('default_contact_id', 'integer', ['default' => null, 'notnull' => false, 'length' => null, 'precision' => 10, 'scale' => 0, 'fixed' => false, 'unsigned' => false, 'autoincrement' => false, 'comment' => '']);
        $table->addColumn('shipping_address_id', 'integer', ['default' => null, 'notnull' => false, 'length' => null, 'precision' => 10, 'scale' => 0, 'fixed' => false, 'unsigned' => false, 'autoincrement' => false, 'comment' => '']);
        $table->addColumn('billing_address_id', 'integer', ['default' => null, 'notnull' => false, 'length' => null, 'precision' => 10, 'scale' => 0, 'fixed' => false, 'unsigned' => false, 'autoincrement' => false, 'comment' => '']);
        $table->addColumn('user_owner_id', 'integer', ['default' => null, 'notnull' => false, 'length' => null, 'precision' => 10, 'scale' => 0, 'fixed' => false, 'unsigned' => false, 'autoincrement' => false, 'comment' => '']);
        $table->addColumn('name', 'string', ['default' => null, 'notnull' => true, 'length' => 255, 'precision' => 10, 'scale' => 0, 'fixed' => false, 'unsigned' => false, 'autoincrement' => false, 'comment' => '']);
        $table->addColumn('createdAt', 'datetime', ['default' => null, 'notnull' => true, 'length' => null, 'precision' => 10, 'scale' => 0, 'fixed' => false, 'unsigned' => false, 'autoincrement' => false, 'comment' => '']);
        $table->addColumn('updatedAt', 'datetime', ['default' => null, 'notnull' => true, 'length' => null, 'precision' => 10, 'scale' => 0, 'fixed' => false, 'unsigned' => false, 'autoincrement' => false, 'comment' => '']);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['user_owner_id'], 'IDX_7166D3719EB185F9', []);
        $table->addIndex(['shipping_address_id'], 'IDX_7166D3714D4CFF2B', []);
        $table->addIndex(['billing_address_id'], 'IDX_7166D37179D0C0E4', []);
        $table->addIndex(['default_contact_id'], 'IDX_7166D371AF827129', []);
        $table->addIndex(['name'], 'account_name_idx', []);
        /** End of generate table orocrm_account **/

        /** Generate table orocrm_account_to_contact **/
        $table = $schema->createTable('orocrm_account_to_contact');
        $table->addColumn('account_id', 'integer', ['default' => null, 'notnull' => true, 'length' => null, 'precision' => 10, 'scale' => 0, 'fixed' => false, 'unsigned' => false, 'autoincrement' => false, 'comment' => '']);
        $table->addColumn('contact_id', 'integer', ['default' => null, 'notnull' => true, 'length' => null, 'precision' => 10, 'scale' => 0, 'fixed' => false, 'unsigned' => false, 'autoincrement' => false, 'comment' => '']);
        $table->setPrimaryKey(['account_id', 'contact_id']);
        $table->addIndex(['account_id'], 'IDX_65B8FBEC9B6B5FBA', []);
        $table->addIndex(['contact_id'], 'IDX_65B8FBECE7A1254A', []);
        /** End of generate table orocrm_account_to_contact **/

        /** Generate foreign keys for table orocrm_account **/
        $table = $schema->getTable('orocrm_account');
        $table->addForeignKeyConstraint($schema->getTable('orocrm_contact'), ['default_contact_id'], ['id'], ['onDelete' => 'SET NULL', 'onUpdate' => null]);
        $table->addForeignKeyConstraint($schema->getTable('oro_address'), ['shipping_address_id'], ['id'], ['onDelete' => 'SET NULL', 'onUpdate' => null]);
        $table->addForeignKeyConstraint($schema->getTable('oro_address'), ['billing_address_id'], ['id'], ['onDelete' => 'SET NULL', 'onUpdate' => null]);
        $table->addForeignKeyConstraint($schema->getTable('oro_user'), ['user_owner_id'], ['id'], ['onDelete' => 'SET NULL', 'onUpdate' => null]);
        /** End of generate foreign keys for table orocrm_account **/

        /** Generate foreign keys for table orocrm_account_to_contact **/
        $table = $schema->getTable('orocrm_account_to_contact');
        $table->addForeignKeyConstraint($schema->getTable('orocrm_contact'), ['contact_id'], ['id'], ['onDelete' => 'CASCADE', 'onUpdate' => null]);
        $table->addForeignKeyConstraint($schema->getTable('orocrm_account'), ['account_id'], ['id'], ['onDelete' => 'CASCADE', 'onUpdate' => null]);
        /** End of generate foreign keys for table orocrm_account_to_contact **/

        // @codingStandardsIgnoreEnd
    }
}
