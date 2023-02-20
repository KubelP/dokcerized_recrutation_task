<?php

namespace App\Service;

use App\Entity\CarBrand;
use Doctrine\ORM\EntityManagerInterface;
use App\Exceptions\CarBrandWrongIdException;

class MutationService
{
    public function __construct(
        private EntityManagerInterface $manager
    ) {}

    public function createCarBrand(array $carBrandDetails): CarBrand
    {
        $carBrand = new CarBrand(
            $carBrandDetails['brand_name'],
            $carBrandDetails['year'],
        );

        $this->manager->persist($carBrand);
        $this->manager->flush();

        return $carBrand;
    }

    public function updateCarBrand($carBrandId, array $carBrandDetails): CarBrand
    {
        $brandToUpdate = $this->manager->getRepository(CarBrand::class)->find($carBrandId);

        if (is_null($brandToUpdate)) {
            throw new CarBrandWrongIdException("No car with this id: $carBrandId");
        }
        $brandToUpdate->setBrandName($carBrandDetails['brand_name']);
        $brandToUpdate->setYear($carBrandDetails['year']);

        $this->manager->persist($brandToUpdate);
        $this->manager->flush();

        return $brandToUpdate;
    }

    public function deleteCarBrand($carBrandId)
    {
        $carBrandToRemove = $this->manager->getRepository(CarBrand::class)->find($carBrandId);

        if (is_null($carBrandToRemove)) {
            throw new CarBrandWrongIdException("No car with this id: $carBrandId");
        }
        $this->manager->remove($carBrandToRemove);
        $this->manager->flush();

        return null;
    }
}
