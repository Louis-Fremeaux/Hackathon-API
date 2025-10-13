<?php

namespace App\Controller;

use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface ApiController
{
    function getId(EntityManagerInterface $entityManager, int $id): JsonResponse;
    function getAll(EntityManagerInterface $entityManager): JsonResponse;
    function create(EntityManagerInterface $entityManager, Request $request): JsonResponse;
    function update(EntityManagerInterface $entityManager, int $id, Request $request): JsonResponse;
    function delete(EntityManagerInterface $entityManager, int $id): JsonResponse;

    function toArray(Participant $p): array;

}
