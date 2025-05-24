<?php

namespace App\Exceptions\Cart;

use Exception;

class EmptyCartException extends Exception
{
    protected $message = 'Cannot proceed with checkout: cart is empty';
    protected $code = 422;
} 