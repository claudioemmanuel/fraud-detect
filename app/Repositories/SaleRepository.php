<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Repositories\Interfaces\ISaleRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class SaleRepository implements ISaleRepository
{
    private Sale $model;

    /**
     * Create a new sale instance.
     *
     * @param Sale $sale
     */
    public function __construct(Sale $sale)
    {
        $this->model = $sale;
    }

    /**
     * @param array $data
     * @return Sale
     * @throws Exception
     */
    public function store(array $data): Sale
    {
        DB::beginTransaction();

        try {
            $sale = $this->model->create($data);
            DB::commit();
            return $sale;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
