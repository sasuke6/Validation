<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:57
 */

namespace Hsucy\Validation;


class PhoneValidation extends BaseValidation
{
    protected $_initOptions = ['phone'];

    protected $_enabledOptions = [];

    protected function phone()
    {
        $value = $this->attributeValue;
        if (!ValidationRule::isPhone($value)) {

            $defaultMessage = "{$this->attribute}不符合手机号格式.";
            $this->setError(__FUNCTION__, $defaultMessage);

            return false;
        }
        return true;
    }

}