<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:24
 */

namespace Hsucy\Validation;


class CallBackValidation extends BaseValidation
{
    protected $_enabledOptions = ['callback'];

    protected function callback($param)
    {
        $value = $this->attributeValue;
        if (!call_user_func_array($param, [$value])) {

            $defaultMessage = "{$this->attribute}是无效的值.";
            $this->setError(__FUNCTION__, $defaultMessage);

            return false;
        }
        return true;
    }

}