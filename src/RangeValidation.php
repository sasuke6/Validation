<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:56
 */

namespace Hsucy\Validation;


class RangeValidation extends BaseValidation
{
    protected $_enabledOptions = ['range', 'strict'];

    protected function range($param)
    {
        $value  = $this->attributeValue;
        $strict = empty($this->settings['strict']) ? false : true;
        if (!ValidationRule::in($value, $param, $strict)) {

            $defaultMessage = "{$this->attribute}不在" . implode(',', $param) . "范围内.";
            $this->setError(__FUNCTION__, $defaultMessage);

            return false;
        }
        return true;
    }

}