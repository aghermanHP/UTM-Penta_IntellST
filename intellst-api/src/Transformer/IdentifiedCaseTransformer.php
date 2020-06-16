<?php

namespace App\Transformer;

use App\DTO\IdentifiedCaseDTO;
use App\Entity\IdentifiedCase;

class IdentifiedCaseTransformer
{
    public function transformDTOToEntity(IdentifiedCaseDTO $dto): IdentifiedCase
    {
        $identifiedCase = new IdentifiedCase();
        $identifiedCase->setPhotoFilename($dto->photoFilename);
        $identifiedCase->setTemperature($dto->temperature);
        $identifiedCase->setDatePhoto(new \DateTime());
        $identifiedCase->setFirstDate(new \DateTime());

        return $identifiedCase;
    }

}
