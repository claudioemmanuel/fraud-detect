<?php

namespace App\Services;

use App\Exceptions\FraudException;
use App\Exceptions\NotAllowedAgeException;
use App\Models\Sale;
use App\Repositories\Interfaces\ISaleRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Storage;

class SaleService
{
    /** @var ISaleRepository */
    private ISaleRepository $saleRepository;

    /**
     * @param ISaleRepository $saleRepository
     */
    public function __construct(ISaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    /**
     * @param array $clientData
     * @return Sale
     * @throws NotAllowedAgeException
     * @throws FraudException
     */
    public function initSale(array $clientData): Sale
    {
        $this->clientCanBuy($clientData['cpf'], $clientData['birth_date']);

        return $this->saleRepository->store($clientData);
    }

    /**
     * @param string $cpf
     * @param string $birthDate
     * @return void
     * @throws FraudException
     * @throws NotAllowedAgeException
     * @throws Exception
     */
    private function clientCanBuy(string $cpf, string $birthDate): void
    {
        if ($this->checkOnIRS($cpf, $birthDate)) {
            throw new FraudException();
        }

        if (!$this->allowedAge($cpf, $birthDate)) {
            throw new NotAllowedAgeException();
        }
    }

    /**
     * Fake API call to check if client is a fraud
     *
     * @param string $cpf
     * @param string $birthDate
     * @return bool
     */
    private function checkOnIRS(string $cpf, string $birthDate): bool
    {
        $disk = Storage::disk('public');

        $file = $disk->get('irs/clients_base.json');

        $clients = json_decode($file, true);

        $isAFraud = false;
        foreach ($clients as $client) {
            if ($client['cpf'] === $cpf && $client['birth_date'] !== $birthDate) {
                $isAFraud = true;
                break;
            }
        }

        return $isAFraud;
    }

    /**
     * @param string $cpf
     * @param string $birthDate
     * @return bool
     * @throws Exception
     */
    private function allowedAge(string $cpf, string $birthDate): bool
    {
        $allowedAge = false;

        $cpfFirstDigit = substr($cpf, 0, 1);
        $birthYear = substr($birthDate, 0, 4);

        if ($cpfFirstDigit === '0' || $cpfFirstDigit === '1' || $cpfFirstDigit === '2' || $cpfFirstDigit === '3') {
            if ($birthYear <= 1950) {
                $allowedAge = true;
            }
        } elseif ($cpfFirstDigit === '4' || $cpfFirstDigit === '5' || $cpfFirstDigit === '6') {
            if ($birthYear <= 2000) {
                $allowedAge = true;
            }
        } elseif ($cpfFirstDigit === '7' || $cpfFirstDigit === '8' || $cpfFirstDigit === '9') {
            $birthDate = new DateTime($birthDate);
            $now = new DateTime();
            $interval = $now->diff($birthDate);
            $age = $interval->y;

            if ($age >= 21) {
                $allowedAge = true;
            }
        }

        return $allowedAge;
    }
}
