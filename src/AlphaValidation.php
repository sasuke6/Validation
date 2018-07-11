<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:20
 */

namespace Hsucy\Validation;


class AlphaValidation extends BaseValidation
{
    protected $_initOptions = ['alpha'];

    protected $_enabledOptions = ['length', 'minLength', 'maxLength'];

    protected function alpha()
    {
        $value = $this->attributeValue;
        if (!ValidationRule::isAlpha($value)) {

            $defaultMessage = "{$this->attribute}只能为字母.";
            $this->setError(__FUNCTION__, $defaultMessage);
 
            return false;
        }
        return true;
    }

}