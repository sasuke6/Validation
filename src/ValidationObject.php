<?php
/**
 * Created by PhpStorm.
 * User: hsucy
 * Date: 09/07/2018
 * Time: 00:40
 */

namespace Hsucy\Validation;


class ValidationObject
{

    public function __construct($attributes = [])
    {

        $this->onConstruct();

        foreach ($attributes as $name => $attribute) {
            $this->$name = $attribute;
        }

        $this->onInitialize();
    }


    public function onConstruct()
    {

    }


    public function onInitialize()
    {

    }


    public function onDestruct()
    {

    }


    public function __destruct()
    {
        $this->onDestruct();
    }

}