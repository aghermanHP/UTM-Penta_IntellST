<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Register;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController extends AbstractController
{
    /**
     * AuthController constructor.
     * @param Register $register
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     */

    public function __construct( Register $register, Request $request, UserPasswordEncoderInterface $encoder) {
        $this->register = $register;
        $this->request = $request;
        $this->encoder = $encoder;
    }
    /**
     * @Route("/register", methods={"POST"})
     */
    public function register():string
    {
        $this->register->register( $this->request, $this->encoder );
    }

    /**
     * @Route("/api")
     */
    public function api() : string
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
}