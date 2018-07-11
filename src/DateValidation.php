<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:26
 */

namespace Hsucy\Validation;


class DateValidation extends BaseValidation
{

    protected $_enabledOptions = ['format'];

    protected function format($param)
    {
        $value = $this->attributeValue;
        if (!ValidationRule::isDate($value, $param)) {

            $defaultMessage = "{$this->attribute}不符合日期格式.";
            $this->setError(__FUNCTION__, $defaultMessage);

            return false;
        }
        return true;
    }

}