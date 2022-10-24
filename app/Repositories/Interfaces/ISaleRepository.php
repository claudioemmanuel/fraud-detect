<?php

namespace App\Repositories\Interfaces;

use App\Models\Sale;

interface ISaleRepository
{
    public function store(array $data): Sale;
}
