<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permission".
 *
 * @property integer $id
 * @property string $table_name
 * @property string $field_name
 * @property string $operation_name
 *
 * @property RolePermission[] $rolePermissions
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_name', 'field_name', 'operation_name'], 'required'],
            [['table_name', 'field_name', 'operation_name'], 'string', 'max' => 50],
            [['table_name', 'field_name', 'operation_name'], 'unique', 'targetAttribute' => ['table_name', 'field_name', 'operation_name'], 'message' => 'The combination of Table Name, Field Name and Operation Name has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Table Name',
            'field_name' => 'Field Name',
            'operation_name' => 'Operation Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolePermissions()
    {
        return $this->hasMany(RolePermission::className(), ['permission_id' => 'id']);
    }
}
