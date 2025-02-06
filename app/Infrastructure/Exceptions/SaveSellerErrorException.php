<?php

namespace App\Infrastructure\Exceptions;

use App\Domain\Entities\Seller;
use Illuminate\Support\Facades\Log;

class SaveSellerErrorException extends InfrastructureException
{
    public function __construct(Seller $seller, string $detailedError = '')
    {
        $message = "Error saving seller: - {$detailedError}";

        parent::__construct($message, 500);

        Log::error($message, [
            'seller' => json_encode($seller),
        ]);
    }
}
