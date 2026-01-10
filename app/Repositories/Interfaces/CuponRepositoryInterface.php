<?php

namespace App\Repositories\Interfaces;

use App\Models\Cupon;

interface CuponRepositoryInterface
{
    public function getAll(int $perPage);
    public function getActive(int $perPage);
    public function getTrashed(int $perPage);
    public function getById(int $id);
    public function getTrashedById(int $id);
    public function create(array $data): Cupon;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function restore(int $id): bool;
    public function forceDelete(int $id): bool;
}