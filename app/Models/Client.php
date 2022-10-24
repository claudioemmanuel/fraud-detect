<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'birth_date',
        'rg',
        'cpf',
        'streetName',
        'buildingNumber',
        'neighborhood',
        'city',
        'state',
        'postcode',
        'profile_photo_path',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
