<?php

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
     /**
     * User ID
     * @var integer
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("ID")
     */
    public int $id;

    /**
     * The firstname of User
     * @var string
     * @Serializer\Type("string")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 70,
     *      minMessage = "Your firstname must be at least 4 characters long",
     *      maxMessage = "Your firstname cannot be longer than 70 characters",
     * )
     * @Serializer\Expose()
     * @Serializer\SerializedName("username")
     */
    public string $firstname;

    /**
     * The lastname of User
     * @var string
     * @Serializer\Type("string")
     * @Assert\NotBlank(groups={"UserAdd"})
     * @Assert\Length(
     *      min = 1,
     *      max = 70,
     *      minMessage = "Your lastname  is required",
     *      maxMessage = "Your lastname cannot be longer than 70 characters",
     * )
     * @Serializer\Expose()
     * @Serializer\SerializedName("username")
     */
    public string $lastname;

    /**
     * User email
     * @var string
     * @Serializer\Type("string")
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     * )
     * @Serializer\Expose()
     * @Serializer\SerializedName("email")
     */
    public string $email;
    /**
     * Password
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose()
     * @Assert\NotNull
     * @Assert\Regex(
     *     "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[-_!@#$%^&*])\S*$/",
     *     message = "Password requirements(at least):length >8, 1 uppercase, 1 lowercase, 1 digit, 1 special",
     * )
     * @Serializer\SerializedName("newPassword")
     */
    public string $password;

    /**
     * The enterprise
     * @var string
     * @Serializer\Type("string")
     * @Assert\NotBlank
     * @Serializer\Expose()
     * @Serializer\SerializedName("enterprise")
     */
    public $enterprise;

}
