<?php

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

class EnterpriseDTO
{
    /**
     * @var integer
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("ID")
     */
    public int $id;

    /**
     * @Serializer\Expose()
     * @Groups({"EnterpriseAdd"})
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     * @var string
     * @Assert\NotBlank
     */
    public string $name;

    /**
     * @Serializer\Expose()
     * @Groups({"EnterpriseAdd"})
     * @Serializer\SerializedName("users")
     */
    public $users;

    /**
     * @Serializer\Expose()
     * @Groups({"EnterpriseAdd"})
     * @Serializer\SerializedName("temperature")
     * @Serializer\Type("float")
     * @var float
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 34,
     *      max = 38,
     *      minMessage = "Enter a higher value",
     *      maxMessage = "Enter a lower value",
     * )
     */
    public float $temperature;

    /**
     * @Serializer\Expose()
     * @Groups({"EnterpriseAdd"})
     * @Serializer\SerializedName("restrictionPeriod")
     * @Serializer\Type("integer")
     * @var integer
     * @Assert\NotBlank
     */
    public int $restrictionPeriod;

}