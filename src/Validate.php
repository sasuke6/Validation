<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 07/07/2018
 * Time: 21:45
 */

namespace Hsucy\Validation;

class Validate extends ValidationObject
{
    //attributes
    public $attributes;

    //scenario
    protected $scenario;

    //validation path
    protected $validators = [
        'alphaNumeric' => '\App\Validation\AlphaNumericValidation',
        'alpha'        => '\App\Validation\AlphaValidation',
        'callBack'     => '\App\Validation\CallBackValidation',
        'compare'      => '\App\Validation\CompareValidation',
        'date'         => '\App\Validation\DateValidation',
        'double'       => '\App\Validation\DoubleValidation',
        'email'        => '\App\Validation\EmailValidation',
        'integer'      => '\App\Validation\IntegerValidation',
        'match'        => '\App\Validation\MatchValidation',
        'phone'        => '\App\Validation\PhoneValidation',
        'range'        => '\App\Validation\RangeValidation',
        'string'       => '\App\Validation\StringValidation',
        'url'          => '\App\Validation\UrlValidation',

    ];

    //errors
    protected $errors = [];

    //get rules
    public function rules()
    {
        return [];
    }

    //get scenario
    public function scenarios()
    {
        return [];
    }

    //return message
    public function messages()
    {
        return [];
    }

    //set scenario current
    public function setScenario($scenario)
    {
        $scenarios = $this->scenarios();
        if (!isset($scenarios[$scenario])) {
            throw new ValidationException("scenario is not exist: {$scenario}");
        }

        if (!isset($scenarios[$scenario]['required'])) {
            throw new ValidationException("scenario {$scenario} undefined required options");
        }

        if (!isset($scenarios[$scenario]['optional'])) {
            $scenarios[$scenario]['optional'] = [];
        }

        $this->scenario = $scenarios[$scenario];
    }

    //validation
    public function validate()
    {
        if (!isset($this->scenario)) {
            throw new ValidationException("scenario not set");
        }
        $this->errors = [];
        $scenario = $this->scenario;
        $scenarioAttributes = array_merge($scenario['required'], $scenario['optional']);
        $rules = $this->rules();
        $messages = $this->messages();

        foreach ($scenarioAttributes as $attribute) {
            if (!isset($rules[$attribute])) {
                throw new ValidationException("attribute '{$attribute}' not defined rule");
            }
        }

        foreach ($rules as $attribute => $rule) {
            if (!in_array($attribute, $scenarioAttributes)) {
                continue;
            }
            $validatorType = array_shift($rule);
            if (!isset($this->validators[$validatorType])) {
                throw new ValidationException("attribute '{$attribute}' of validation type '{$validatorType}' not exist");
            }
            $attributeValue = isset($this->attributes[$attribute]) ? $this->attributes[$attribute] : null;

            $validatorClass = $this->validators[$validatorType];
            $validator = new $validatorClass([
                'isRequired'     => in_array($attribute, $scenario['required']),
                'options'        => $rule,
                'attribute'      => $attribute,
                'attributeValue' => $attributeValue,
                'messages'       => $messages,
                'attributes'     => $this->attributes,
            ]);
            $validator->mainValidator = $this;

            if (!$validator->validate()) {

                $this->errors[$attribute] = $validator->errors;
            }
        }
        return empty($this->errors);
    }

    // return errors
    public function getErrors()
    {
        return $this->errors;
    }

    // return an error
    public function getError()
    {
        $errors = $this->errors;
        if (empty($errors)) {
            return '';
        }
        $item = array_shift($errors);
        $error = array_shift($item);
        return $error;
    }

}