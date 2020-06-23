<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\getDoctrine;


class Register extends AbstractController
{
    /**
     * Register constructor.
     * @param RequestStack $requestStack
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(RequestStack $requestStack, UserPasswordEncoderInterface $encoder)
    {
        $this->requestStack = $requestStack;
        $this->encoder = $encoder;
    }

    public function register() : string
    {
        $em = $this->getDoctrine()->getManager();

        $username = $this->requestStack->getCurrentRequest()->request->get('username');
        $password = $this->requestStack->getCurrentRequest()->request->get('password');

        $user = new User($username);
        $user->setPassword($this->encoder->encodePassword($user, $password));
        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }
}
