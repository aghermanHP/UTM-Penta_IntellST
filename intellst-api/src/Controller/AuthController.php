<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \App\Service\Register;

class AuthController extends AbstractController
{
    /**
     * AuthController constructor.
     * @param Register $register
     */
    public function __construct(Register $register)
    {
        $this->register = $register;
    }

    /**
     * @Route("/register", methods={"POST"})
     */
    public function register(): string
    {
        return $this->register->register();
    }

    /**
     * @Route("/api")
     */
    public function api(): string
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
}
