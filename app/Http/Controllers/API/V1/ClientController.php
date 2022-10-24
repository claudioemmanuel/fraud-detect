<?php

namespace App\Http\Controllers\API\V1;

use App\Exceptions\InvalidCpfException;
use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreClientRequest;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ClientController extends Controller
{

    /** @var ClientService */
    private ClientService $clientService;

    /**
     * @param ClientService $clientService
     */
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @param StoreClientRequest $request
     * @return JsonResponse
     */
    public function store(StoreClientRequest $request): JsonResponse
    {
        try {
            $client = $this->clientService->store($request->all());
            return response()->json($client, ResponseAlias::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param string $cpf
     * @return JsonResponse
     */
    public function validateCpf(string $cpf): JsonResponse
    {
        try {
            return response()->json($this->clientService->validateCpf($cpf), ResponseAlias::HTTP_OK);
        } catch (InvalidCpfException $e) {
            return response()->json($e->getMessage(), ResponseAlias::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
