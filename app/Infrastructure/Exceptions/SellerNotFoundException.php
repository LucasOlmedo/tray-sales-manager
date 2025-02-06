<?php

namespace App\Infrastructure\Exceptions;

use App\Infrastructure\Exceptions\InfrastructureException;
use Exception;

class SellerNotFoundException extends InfrastructureException
{
    public function __construct(Exception $previous = null)
    {
        parent::__construct(message: 'Seller not found', code: 404, previous: $previous);
    }
}
