<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\IClientRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ClientRepository implements IClientRepository
{
    private Client $model;

    /**
     * Create a new client instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    /**
     * @param array $data
     * @return Client
     * @throws Exception
     */
    public function store(array $data): Client
    {
        DB::beginTransaction();

        try {
            $client = $this->model->create($data);
            DB::commit();
            return $client;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param string $cpf
     * @return Client|null
     */
    public function getByCpf(string $cpf): Client|null
    {
        return $this->model->where('cpf', $cpf)->first();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }
}
