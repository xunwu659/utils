<?php


namespace services;

use FormBuilder\Factory\Iview as Form;

/**
 * Form Builder
 * Class FormBuilder
 * @package services
 */
class FormBuilder extends Form
{

    public static function setOptions($call){
        if (is_array($call)) {
            return $call;
        }else{
            return  $call();
        }

    }


}
