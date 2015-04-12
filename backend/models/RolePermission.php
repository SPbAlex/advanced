<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_permission".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $permission_id
 *
 * @property Permission $permission
 * @property Role $role
 */
class RolePermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'permission_id'], 'required'],
            [['role_id', 'permission_id'], 'integer'],
            [['role_id', 'permission_id'], 'unique', 'targetAttribute' => ['role_id', 'permission_id'], 'message' => 'The combination of Role ID and Permission ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'permission_id' => 'Permission ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermission()
    {
        return $this->hasOne(Permission::className(), ['id' => 'permission_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }
}
