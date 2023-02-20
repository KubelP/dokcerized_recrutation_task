<?php

namespace App\Service;

use App\Entity\CarBrand;
use App\Repository\CarBrandRepository;
use App\Exceptions\CarBrandWrongIdException;


class QueryService
{
    public function __construct(
        private CarBrandRepository $CarBrandRepository,
    ) {}

    public function findCarBrand($carBrandId): CarBrand
    {
        $brand = $this->CarBrandRepository->find($carBrandId);

        if (is_null($brand)) {
            throw new CarBrandWrongIdException("No car with this id: $carBrandId");
        }

        return $brand;
    }

    public function getAllCarBrands(): array
    {
        return $this->CarBrandRepository->findAll();
    }
}
