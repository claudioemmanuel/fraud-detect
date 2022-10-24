<?php

namespace Database\Factories;

use App\Models\Client;
use Faker\Provider\pt_BR\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\pt_BR\Address;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');
        $faker->addProvider(new Address($faker));
        $faker->addProvider(new Person($faker));

        $cpf = $faker->cpf(false);
        $cpfFirstDigit = substr($cpf, 0, 1);

        $birthDate = '1990-01-01';

        if ($cpfFirstDigit === '0' || $cpfFirstDigit === '1' || $cpfFirstDigit === '2' || $cpfFirstDigit === '3') {
            $birthDate = $faker->dateTimeBetween('-100 years', '-72 years')->format('Y-m-d');
        } elseif ($cpfFirstDigit === '4' || $cpfFirstDigit === '5' || $cpfFirstDigit === '6') {
            $birthDate = $faker->dateTimeBetween('-71 years', '-22 years')->format('Y-m-d');
        } elseif ($cpfFirstDigit === '7' || $cpfFirstDigit === '8' || $cpfFirstDigit === '9') {
            $birthDate = $faker->dateTimeBetween('-21 years', 'now')->format('Y-m-d');
        }

        return [
            'name' => $faker->name,
            'birth_date' => $birthDate,
            'rg' => $faker->rg(false),
            'cpf' => $cpf,
            'streetName' => $faker->streetName,
            'buildingNumber' => $faker->buildingNumber,
            'neighborhood' => $faker->citySuffix,
            'city' => $faker->city,
            'state' => $faker->stateAbbr,
            'postcode' => $faker->postcode,
            'profile_photo_path' => $faker->imageUrl($width = 640, $height = 480),
        ];
    }
}
