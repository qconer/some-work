<?php

namespace App\Exception;

use Exception;

class ChoiceException extends Exception // ChoiceNotFoundException.
{
    protected $message = 'Choice not found';
}