<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 07/07/2018
 * Time: 22:13
 */

namespace Hsucy\Validation;


class BaseValidation extends ValidationObject
{
    //require field
    public $isRequired;

    //need to validate option
    public $options;

    //current attribute
    public $attribute;

    //current attribute value
    public $attributeValue;

    //all message
    public $messages;

    //all attribute
    public $attributes;

    //main validator reference
    public $mainValidator;

    //error
    public $errors = [];

    // setting
    protected $settings = [];

    //init options
    protected $initOptions = [];

    //use options
    protected $enableOptions = [];

    //validate
    public function validate()
    {
        //clear data cache
        $this->errors = [];
        $this->settings = [];

        //validate
        if ($this->required() && !is_null($this->attributeValue)) {
            foreach ($this->options as $name => $option) {
                if (!in_array($name, $this->enableOptions)) {
                    throw new ValidationException("attribute '{$this->attribute}' of validation '{$name}' not exist");
                }

                if (!method_exists($this, $name)) {
                    $this->settings[$name] = $option;
                    unset($this->options[$name]);
                }
            }

            foreach ($this->initOptions as $option) {
                $this->options = array_merge([$option => null], $this->options);
            }

            foreach ($this->options as $name => $param) {
                $success = $this->$name($param);
                if (!$success) {
                    break;
                }
            }

            $result = empty($this->errors);

            $attribute = $this->attribute;
            if (!$result) {
                $this->mainValidator->$attribute = null;
            } else {
                $this->mainValidator->$attribute = $this->attributeValue;
            }

            return $result;
        }
    }

    // have to validate
    protected function required()
    {
        $value = $this->attributeValue;
        if ($this->isRequired && is_null($value)) {
            // 设置错误消息
            $defaultMessage = "{$this->attribute}不能为空.";
            $this->setError(__FUNCTION__, $defaultMessage);
            // 返回
            return false;
        }
        return true;
    }

    // set error message
    protected function setError($option, $defaultMessage)
    {
        $message = $this->getMessage($this->attribute, $option);
        if (is_null($message)) {
            $message = $defaultMessage;
        }
        $this->errors[$option] = $message;
    }

    // get message
    protected function getMessage($attribute, $option)
    {
        $messages = $this->messages;
        if (isset($messages["{$attribute}.{$option}"])) {
            return $messages["{$attribute}.{$option}"];
        }
        if (isset($messages[$attribute])) {
            return $messages[$attribute];
        }
        return null;
    }


    protected function unsigned($param)
    {
        $value = $this->attributeValue;
        if ($param && substr($value, 0, 1) == '-') {
            // 设置错误消息
            $defaultMessage = "{$this->attribute}不能为负数.";
            $this->setError(__FUNCTION__, $defaultMessage);
            // 返回
            return false;
        }
        return true;
    }

    // 最小数值验证
    protected function min($param)
    {
        $value = $this->attributeValue;
        if (is_numeric($value) && $value < $param) {
            // 设置错误消息
            $defaultMessage = "{$this->attribute}不能小于{$param}.";
            $this->setError(__FUNCTION__, $defaultMessage);
            // 返回
            return false;
        }
        return true;
    }

    // 最大数值验证
    protected function max($param)
    {
        $value = $this->attributeValue;
        if (is_numeric($value) && $value > $param) {
            // 设置错误消息
            $defaultMessage = "{$this->attribute}不能大于{$param}.";
            $this->setError(__FUNCTION__, $defaultMessage);
            // 返回
            return false;
        }
        return true;
    }

    // 固定长度验证
    protected function length($param)
    {
        $value = $this->attributeValue;
        if (mb_strlen($value) != $param) {
            // 设置错误消息
            $defaultMessage = "{$this->attribute}长度只能为{$param}位.";
            $this->setError(__FUNCTION__, $defaultMessage);
            // 返回
            return false;
        }
        return true;
    }

    // 最小长度验证
    protected function minLength($param)
    {
        $value = $this->attributeValue;
        if (mb_strlen($value) < $param) {
            // 设置错误消息
            $defaultMessage = "{$this->attribute}长度不能小于{$param}位.";
            $this->setError(__FUNCTION__, $defaultMessage);
            // 返回
            return false;
        }
        return true;
    }

    // 最大长度验证
    protected function maxLength($param)
    {
        $value = $this->attributeValue;
        if (mb_strlen($value) > $param) {
            // 设置错误消息
            $defaultMessage = "{$this->attribute}长度不能大于{$param}位.";
            $this->setError(__FUNCTION__, $defaultMessage);
            // 返回
            return false;
        }
        return true;
    }


}