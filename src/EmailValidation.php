<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:28
 */

namespace Hsucy\Validation;


class EmailValidation extends BaseValidation
{
    protected $_initOptions = ['email'];

    protected $_enabledOptions = ['length', 'minLength', 'maxLength'];

    protected function email()
    {
        $value = $this->attributeValue;
        if (!ValidationRule::isEmail($value)) {

            $defaultMessage = "{$this->attribute}不符合邮箱格式.";
            $this->setError(__FUNCTION__, $defaultMessage);

            return false;
        }
        return true;
    }

}