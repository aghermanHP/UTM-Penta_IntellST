<?php

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class AllowEntranceDTO
{
    /**
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("ID")
     */
    public int $id;

    /**
     * @Serializer\Expose()
     * @Serializer\SerializedName("allowEntrance")
     * @Serializer\Type("bool")
     * @Assert\NotBlank
     * @Assert\IsFalse(message="Entry denied.")
     */
    public bool $allowEntrance;

}