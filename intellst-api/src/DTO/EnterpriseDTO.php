<?php

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     * @var string
     * @Assert\NotBlank
     */
    public string $name;

    /**
     * @Serializer\Expose()
     * @Serializer\SerializedName("users")
     * @Assert\NotBlank
     */
    public $users;

    /**
     * @Serializer\Expose()
     * @Groups({"EnterpriseEdit"})
     * @Serializer\SerializedName("temperature")
     * @Serializer\Type("float")
     * @var float
     * @Assert\NotBlank (groups={"EnterpriseEdit"})
     * @Assert\Range(
     *      min = 34,
     *      max = 38,
     *      minMessage = "Enter a higher value",
     *      maxMessage = "Enter a lower value",
     *      groups={"EnterpriseEdit"}
     * )
     */
    public float $temperature;

    /**
     * @Serializer\Expose()
     * @Groups({"EnterpriseEdit"})
     * @Serializer\SerializedName("restrictionPeriod")
     * @Serializer\Type("integer")
     * @var integer
     * @Assert\NotBlank (groups={"EnterpriseEdit"})
     */
    public int $restrictionPeriod;

}
