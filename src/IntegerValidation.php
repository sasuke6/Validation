<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 07/07/2018
 * Time: 23:10
 */

namespace Hsucy\Validation;


class IntegerValidation extends BaseValidation
{
    protected $initOptions = ['integer'];

    protected $enableOptions = ['unsigned', 'min', 'max', 'length', 'minLength', 'maxLength'];

    protected function integer()
    {
        $value = $this->attributeValue;

        if (!ValidationRule::isInteger($value)) {

            $defaultMessage = "{$this->attribute}只能为整数.";
            $this->setError(__FUNCTION__, $defaultMessage);

            return false;
        }
        return true;
    }

}