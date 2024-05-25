<?php

// src/EventListener/JwtCreatedListener.php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class JwtCreatedListener
{

    public function __construct(private SerialozerInterface $serializer)
    {
    }

    public function onJwtCreated(JWTCreatedEvent $event) // to nie działa
    {
        $payload = $event->getData();
        $user = $event->getUser();
        error_log("tutaj");
        error_log($user->getId());
        if ($user instanceof UserInterface) {
            $payload['userId'] = $user->getId(); // Dodanie ID użytkownika do danych tokena JWT
        }

        $event->setData($payload);
    }
}
