<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\getDoctrine;


class Register
{
    /**
     * Register constructor.
     * @param RequestStack $request
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(RequestStack $request, UserPasswordEncoderInterface $encoder)
    {
        $this->request = $request;
        $this->encoder = $encoder;
    }

    public function register() : string
    {
        $em = $this->getDoctrine()->getManager();

        $username = $this->request->request->get('username');
        $password = $this->request->request->get('password');

        $user = new User($username);
        $user->setPassword($this->encoder->encodePassword($user, $password));
        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }
}
