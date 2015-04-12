<?php
namespace console\controllers;
use Yii;


class RoleController {
    private $id;
    public function __construct($userId = null) {
        $this->id = Yii::$app->user->id;
        if (!is_null($userId)) {
            $this->id = $userId;
        }
    }

    public function can ($tableName, $fieldName, $operation) {


    }


    public function __toString() {
        return (String)$this->id;
    }
} 