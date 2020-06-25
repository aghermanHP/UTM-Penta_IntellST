<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Enterprise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\getDoctrine;


class Register extends AbstractController
{
    protected $request;
    public function __construct( RequestStack $requestStack, UserPasswordEncoderInterface $encoder)
    {
        $this->requestStack = $requestStack;
        $this->encoder = $encoder;
    }

    public function register() : string
    {
        $em = $this->getDoctrine()->getManager();

        $this->request = $this->requestStack->getCurrentRequest();
        $decoder = json_decode($this->request->getContent(), true);
        $firstName = $decoder['firstName'];
        $lastName = $decoder['lastName'];
        $enterpriseId = $decoder['enterprise'];
        $email = $decoder['username'];
        $password = $decoder['password'];
        $user = new User();
        $user->setEmail($email);
        $user->setFirstname($firstName);
        $user->setLastname($lastName);
        $user->setEnterprise($enterpriseId);
        $user->setPassword($this->encoder->encodePassword($user, $password));
        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }
}
