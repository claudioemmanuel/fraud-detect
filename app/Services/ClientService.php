<?php

namespace App\Services;

use App\Exceptions\InvalidCpfException;
use App\Models\Client;
use App\Repositories\Interfaces\IClientRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ClientService
{
    /** @var IClientRepository  */
    private IClientRepository $clientRepository;

    /**
     * @param IClientRepository $clientRepository
     */
    public function __construct(IClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param string $cpf
     * @return bool
     * @throws InvalidCpfException
     */
    public function validateCpf(string $cpf): bool
    {
        if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            throw new InvalidCpfException();
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf[$c] != $d) {
                throw new InvalidCpfException();
            }
        }

//         Comentado para que seja possível o cadastro de um cliente com o mesmo CPF
//         Possibilitando o teste de fraude de CPF na tela de vendas
//        if ($this->clientRepository->getByCpf($cpf)) {
//             throw new InvalidCpfException('CPF already exists');
//        }

        return true;
    }

    /**
     * @param array $data
     * @return Client
     */
    public function store(array $data): Client
    {
        $data['cpf'] = str_replace(['.', '-'], '', $data['cpf']);
        $data['rg'] = str_replace(['.', '-'], '', $data['rg']);

        if (isset($data['profile_photo_path'])) {
            $data['profile_photo_path'] = $this->uploadProfilePhoto($data['profile_photo_path'], $data['cpf']);
        }

        return $this->clientRepository->store($data);
    }

    /**
     * @param mixed $profile_photo_path
     * @param string $cpf
     * @return string
     */
    private function uploadProfilePhoto(mixed $profile_photo_path, string $cpf): string
    {
        $disk = Storage::disk('public');

        if ($disk->exists('profile_photos/' . $cpf . '.' . $profile_photo_path->extension())) {
            $disk->delete('profile_photos/' . $cpf . '.' . $profile_photo_path->extension());
        }

        return $profile_photo_path->storeAs('profile_photos', $cpf . '.' . $profile_photo_path->extension(), 'public');
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->clientRepository->getAll();
    }
}
