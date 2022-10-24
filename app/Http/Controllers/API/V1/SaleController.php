<?php

namespace App\Http\Controllers\API\V1;

use App\Exceptions\FraudException;
use App\Exceptions\NotAllowedAgeException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleRequest;
use App\Services\SaleService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Http\JsonResponse;
use Exception;

class SaleController extends Controller
{
    /** @var SaleService */
    private SaleService $saleService;

    /**
     * @param SaleService $saleService
     */
    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * @param StoreSaleRequest $request
     * @return JsonResponse
     */
    public function initSale(StoreSaleRequest $request): JsonResponse
    {
        try {
            $sale = $this->saleService->initSale($request->all()['client']);
            return response()->json($sale, ResponseAlias::HTTP_CREATED);
        } catch (NotAllowedAgeException|FraudException $e) {
            return response()->json($e->getMessage(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
