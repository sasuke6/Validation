<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:57
 */

namespace Hsucy\Validation;


class MatchValidation extends BaseValidation
{
    protected $_enabledOptions = ['pattern'];

    protected function pattern($param)
    {
        $value = $this->attributeValue;
        if (!ValidationRule::match($value, $param)) {
            // 设置错误消息
            $defaultMessage = "{$this->attribute}是无效的值.";
            $this->setError(__FUNCTION__, $defaultMessage);
            // 返回
            return false;
        }
        return true;
    }

}