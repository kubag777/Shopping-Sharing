<?php
// api/src/State/UserPasswordHasher.php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

/**
 * @implements ProcessorInterface<User, User|void>
 */
final readonly class UserPasswordHasher implements ProcessorInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.persist_processor')]
        private ProcessorInterface $processor,
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    /**
     * @param User $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): User
    {
        error_log("TUTAJ");
        error_log($data->getPlainPassword());
        error_log($data->getEmail());
        if (!$data->getPlainPassword()) {
            return $this->processor->process($data, $operation, $uriVariables, $context);
        }


        $hashedPassword = $this->passwordHasher->hashPassword(
            $data,
            $data->getPlainPassword()
        );
        $data->setPassword($hashedPassword);
        $data->eraseCredentials();

        return $this->processor->process($data, $operation, $uriVariables, $context);
    }
}