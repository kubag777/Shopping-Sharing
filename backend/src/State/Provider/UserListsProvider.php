<?php

namespace App\State\Provider;

use ApiPlatform\Doctrine\Orm\Paginator;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\User;
use App\Repository\MyListRepository;
use Symfony\Bundle\SecurityBundle\Security;

readonly class UserListsProvider implements ProviderInterface
{

    public function __construct(
        private MyListRepository       $repository,
        private Security               $security,)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|null|object
    {
        $currentUser = $this->security->getUser();
        error_log($currentUser->getId());
        error_log("here");
        $userId = $currentUser->getId();
        if ($currentUser) {
            return new Paginator($this->repository->findByUserId($userId));
        }
        return new Paginator($this->repository->findByUserId("1"));
        
    }
}
