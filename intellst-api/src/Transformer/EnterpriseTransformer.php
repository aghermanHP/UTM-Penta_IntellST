<?php

namespace App\Transformer;

use App\DTO\EnterpriseDTO;
use App\Entity\Enterprise;

class EnterpriseTransformer
{
    public function transformDTOToEntity(EnterpriseDTO $dto, ?Enterprise $enterprise = null): Enterprise
    {
        if ($enterprise === null) {
            $enterprise = new Enterprise();
            $enterprise->setName($dto->name);
        }

        $enterprise->setRestrictionPeriod($dto->temperature);
        $enterprise->setRestrictionPeriod($dto->restrictionPeriod);

        return $enterprise;
    }

    public function transformEntityToDTO(Enterprise $enterprise): EnterpriseDTO
    {

        $enterpriseDTO = new EnterpriseDTO();
        $enterpriseDTO->id = $enterprise->getId();
        $enterpriseDTO->name = $enterprise->getName();
        $enterpriseDTO->temperature = $enterprise->getTemperature();
        $enterpriseDTO->restrictionPeriod = $enterprise->getRestrictionPeriod();

        return $enterpriseDTO;
    }

}