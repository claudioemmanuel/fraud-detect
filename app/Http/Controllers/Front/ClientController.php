<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Contracts\View\View;

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
     * @return View
     */
    public function clientSales(): View
    {
        $clients = $this->clientService->getAll();
        return view('clients.sales', compact('clients'));
    }

    /**
     * @return View
     */
    public function clientRegister(): View
    {
        return view('clients.register');
    }
}
