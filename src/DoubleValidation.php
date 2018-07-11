<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:27
 */

namespace Hsucy\Validation;


class DoubleValidation extends BaseValidation
{
    protected $_initOptions = ['double'];

    protected $_enabledOptions = ['unsigned', 'min', 'max', 'length', 'minLength', 'maxLength'];

    protected function double()
    {
        $value = $this->attributeValue;
        if (!ValidationRule::isDouble($value)) {

            $defaultMessage = "{$this->attribute}只能为小数.";
            $this->setError(__FUNCTION__, $defaultMessage);

            return false;
        }
        return true;
    }

}