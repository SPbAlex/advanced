<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m150412_113307_create_roles extends Migration
    {
        public function up()
        {
            $this->createTable('permission', [
                'id'             => 'int(11) NOT NULL auto_increment PRIMARY KEY',
                'table_name'     => 'VARCHAR(50) NOT NULL',
                'field_name'     => 'VARCHAR(50) NOT NULL',
                'operation_name' => 'VARCHAR(50) NOT NULL',
            ]);
            $this->createIndex('unique', 'permission', ['table_name', 'field_name', 'operation_name'], true);

            $this->createTable('role', [
                'id'   => 'int(11) NOT NULL auto_increment PRIMARY KEY',
                'name' => 'VARCHAR(50) NOT NULL',
            ]);
            $this->createIndex('unique', 'role', 'name', true);

            $this->createTable('role_permission', [
                'id'            => 'int(11) NOT NULL auto_increment PRIMARY KEY',
                'role_id'       => 'int(11) NOT NULL',
                'permission_id' => 'int(11) NOT NULL',
            ]);
            $this->addForeignKey('role_id', 'role_permission', 'role_id', 'role', 'id');
            $this->addForeignKey('permission_id', 'role_permission', 'permission_id', 'permission', 'id');
            $this->createIndex('unique', 'role_permission',  ['role_id', 'permission_id'], true);
/////////////////////////////////////////////////////////////////
            $this->insert('role', ['name' => 'admin']);
            $this->insert('role', ['name' => 'sec_admin']);
            $this->insert('role', ['name' => 'manager']);
            $this->insert('role', ['name' => 'operator']);
            $this->insert('role', ['name' => 'director']);


            $this->addColumn('user', 'role', 'VARCHAR(50) NOT NULL DEFAULT "admin"');
        }

        public function down()
        {
            $this->dropColumn('user', 'role');
            $this->dropTable('role_permission');
            $this->dropTable('role');
            $this->dropTable('permission');
        }

/*
        // Use safeUp/safeDown to run migration code within a transaction
        public function safeUp()
        {
            $this->createTable('permission', [
                'id'             => 'int(11) NOT NULL auto_increment PRIMARY KEY',
                'table_name'     => 'VARCHAR(50) NOT NULL',
                'field_name'     => 'VARCHAR(50) NOT NULL',
                'operation_name' => 'VARCHAR(50) NOT NULL',
            ]);
            $this->createIndex('permission', 'permission', ['table_name, field_name', 'operation_name'], true);

            $this->createTable('role', [
                'id'   => 'int(11) NOT NULL auto_increment PRIMARY KEY',
                'name' => 'VARCHAR(50) NOT NULL',
            ]);
            $this->createIndex('name', 'role', 'name', true);

            $this->createTable('role_permission', [
                'id'            => 'int(11) NOT NULL auto_increment PRIMARY KEY',
                'role_id'       => 'int(11) NOT NULL',
                'permission_id' => 'int(11) NOT NULL',
            ]);
            $this->addForeignKey('role_id', 'role_permission', 'role_id', 'role', 'id');
            $this->addForeignKey('permission_id', 'role_permission', 'permission_id', 'permission', 'id');
        }

        public function safeDown()
        {
            $this->dropTable('permission');
            $this->dropTable('role');
            $this->dropTable('role_permission');

        }
*/
    }
