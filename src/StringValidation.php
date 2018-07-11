<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 11/07/2018
 * Time: 22:58
 */

namespace Hsucy\Validation;


class StringValidation extends BaseValidation
{
    protected $_enabledOptions = ['length', 'minLength', 'maxLength', 'filter'];

    protected function filter($param)
    {
        foreach ($param as $value) {
            switch ($value) {
                case 'trim':
                    $this->attributeValue = trim($this->attributeValue);
                    break;
                case 'strip_tags':
                    $this->attributeValue = strip_tags($this->attributeValue);
                    break;
                case 'htmlspecialchars':
                    $this->attributeValue = htmlspecialchars($this->attributeValue);
                    break;
            }
        }
        return true;
    }

}