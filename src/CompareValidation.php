<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:25
 */

namespace Hsucy\Validation;


class CompareValidation extends BaseValidation
{

    protected $_enabledOptions = ['compareAttribute'];


    protected function compareAttribute($param)
    {
        $value = $this->attributeValue;
        if (!isset($this->attributes[$param]) || $value != $this->attributes[$param]) {

            $defaultMessage = "{$this->attribute}不等于{$param}.";
            $this->setError(__FUNCTION__, $defaultMessage);

            return false;
        }
        return true;
    }

}