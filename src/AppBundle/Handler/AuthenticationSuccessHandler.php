<?php

namespace AppBundle\Handler;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\Security\Http\HttpUtils;

class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler {

    protected $jwtManager;

    public function __construct( JWTManager $jwtManager, HttpUtils $httpUtils, array $options ) {
        $this->jwtManager = $jwtManager;
        parent::__construct( $httpUtils, $options );
    }

    public function onAuthenticationSuccess( Request $request, TokenInterface $token ) {
        $jwt = $this->jwtManager->create($token->getUser());

        $response = new RedirectResponse($this->httpUtils->generateUri($request, $this->determineTargetUrl($request)), 302);
        $response->headers->setCookie(new Cookie("BEARER", $jwt));

        return $response;
    }
}