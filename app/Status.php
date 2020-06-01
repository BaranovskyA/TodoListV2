<?php


namespace App;


use phpDocumentor\Reflection\Types\Self_;

class Status
{
    const list = [
        'Без статуса',
        'Срочно',
        'Важно',
        'Долгосрочно'
    ];

    static function list() {
        return self::list;
    }

    public function validate($attribute, $value, $parameters, $validator) {
        $list = Status::list();
        return isset($list[$value]);
    }

}
