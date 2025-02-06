<?php

namespace App\Infrastructure\Exceptions;

use App\Domain\Entities\Sale;
use Illuminate\Support\Facades\Log;

class SaveSaleErrorException extends InfrastructureException
{
    public function __construct(Sale $sale, string $detailedError = '')
    {
        $message = "Error saving sale: - {$detailedError}";

        parent::__construct($message, 500);

        Log::error($message, [
            'sale' => json_encode($sale),
        ]);
    }
}
