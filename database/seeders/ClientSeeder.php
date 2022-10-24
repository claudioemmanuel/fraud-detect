<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disk = Storage::disk('public');

        if ($disk->exists('irs/clients_base.json')) {
            $disk->delete('irs/clients_base.json');
        }

        $clients = Client::factory(20)->make();

        $data = [];
        $clients->each(function ($client) use ($disk, &$data) {
            $data[] = $client->toArray();
            $client->save();
        });

        $disk->append('irs/clients_base.json', json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }
}
