<?php
    namespace console\controllers;

    use backend\models\Permission;
    use backend\models\RolePermission;
    use common\models\User;
    use Yii;
    use backend\models\Role;


    class RoleController
    {
        private $id;
        private $role_id;
        private $role;

        public function __construct($userId = null)
        {
            $this->id = Yii::$app->user->id;
            if (!is_null($userId)) {
                $this->id = $userId;
            }
            $this->role = User::findOne(['id' => $this->id])->role;
            $this->role_id = Role::findOne(['name' => $this->role])->id;
        }

        public function can($tableName, $fieldName, $operation)
        {
            if ($this->role == 'admin') {
                return true;
            }

            foreach (RolePermission::findAll(['role_id' => $this->role_id]) as $permission) {
                /* @var $perm Permission */
                $perm = Permission::findOne(['id' => $permission->id]);
                if ($perm->table_name == $tableName && $perm->field_name == $fieldName &&
                    $perm->operation_name == $operation
                ) {
                    return true;
                }
            }

            return false;
        }


        public function __toString()
        {
            return (String)$this->id;
        }
    }