<?php

namespace App\Exception;

use Exception;

class ChoiceException extends Exception
{
    protected $message = 'Choice not found';
}