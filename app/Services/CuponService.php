<?php

namespace App\Services;

use App\Repositories\Interfaces\CuponRepositoryInterface;

class CuponService
{
    protected $cuponRepository;

    public function __construct(CuponRepositoryInterface $cuponRepository)
    {
        $this->cuponRepository = $cuponRepository;
    }

    public function getAllCupons(int $perPage = 10)
    {
        return $this->cuponRepository->getAll($perPage);
    }

    public function getTrashedCupons(int $perPage = 10)
    {
        return $this->cuponRepository->getTrashed($perPage);
    }

    public function createCupon(array $data)
    {
        // The request uses 'date' but the database column is 'end_cupon'
        $data['end_cupon'] = $data['date'];
        return $this->cuponRepository->create($data);
    }

    public function updateCupon(int $id, array $data)
    {
        $data['end_cupon'] = $data['date'];
        return $this->cuponRepository->update($id, $data);
    }

    public function deleteCupon(int $id)
    {
        return $this->cuponRepository->delete($id);
    }

    public function restoreCupon(int $id)
    {
        return $this->cuponRepository->restore($id);
    }

    public function forceDeleteCupon(int $id)
    {
        return $this->cuponRepository->forceDelete($id);
    }
}