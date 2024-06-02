<?php

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\MyList;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class MyListProcessor implements ProcessorInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function process($data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        try {
            if (!$data instanceof MyList) {
                throw new \RuntimeException('Expected an instance of MyList');
            }
            // Sprawdź czy OwnerUserID jest ustawiony
            $ownerUserId = $data->getOwnerUserID();
            //error_log($ownerUserId);
            if (null === $ownerUserId) {
                throw new \RuntimeException('OwnerUserID is not set in MyList');
            }

            // Jeśli wszystko jest w porządku, kontynuuj przetwarzanie
            $data->setCreateDate(new \DateTime());
            $this->entityManager->persist($data);
            $this->entityManager->flush();

            $request = $context['request'] ?? null;
            if ($request instanceof Request) {
                $request->attributes->set('_api_item_operation_name', 'addList');
            }
        } catch (\Exception $e) {
            // Log the error
            error_log('An error occurred while processing MyList: ' . $e->getMessage());

            // Rethrow the exception to propagate it further
            throw $e;
        }
    }
}
