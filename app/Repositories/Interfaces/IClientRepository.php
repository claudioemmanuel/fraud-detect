<?php

namespace App\Repositories\Interfaces;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

interface IClientRepository
{
    public function store(array $data): Client;

    public function getByCpf(string $cpf): Client|null;

    public function getAll(): Collection;
}
