<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:59
 */

namespace Hsucy\Validation;


class UrlValidation extends BaseValidation
{
    protected $_initOptions = ['url'];

    protected $_enabledOptions = ['length', 'minLength', 'maxLength'];

    protected function url()
    {
        $value = $this->attributeValue;
        if (!ValidationRule::isUrl($value)) {

            $defaultMessage = "{$this->attribute}不符合网址格式.";
            $this->setError(__FUNCTION__, $defaultMessage);

            return false;
        }
        return true;
    }

}