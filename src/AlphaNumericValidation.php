<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:19
 */

namespace Hsucy\Validation;


class AlphaNumericValidation extends BaseValidation
{
    protected $_initOptions = ['alphaNumeric'];

    protected $_enabledOptions = ['length', 'minLength', 'maxLength'];

    protected function alphaNumeric()
    {
        $value = $this->attributeValue;
        if (!ValidationRule::isAlphaNumeric($value)) {

            $defaultMessage = "{$this->attribute}只能为字母和数字.";
            $this->setError(__FUNCTION__, $defaultMessage);

            return false;
        }
        return true;
    }

}