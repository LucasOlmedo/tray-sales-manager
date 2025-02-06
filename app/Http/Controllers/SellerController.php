<?php

namespace App\Http\Controllers;

use App\Application\Services\SellerService;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Resources\SellerResource;
use Exception;
use Illuminate\Http\JsonResponse;

class SellerController extends Controller
{
    public function __construct(private SellerService $sellerService)
    {
    }

    public function index(): void
    {
        //
    }

    public function store(StoreSellerRequest $request): SellerResource|JsonResponse
    {
        try {
            $data = $request->validated();
            $seller = $this->sellerService->createSeller($data);
            return new SellerResource($seller);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
