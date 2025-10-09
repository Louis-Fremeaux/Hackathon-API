<?php

namespace App\Controller;

use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ParticipantController extends AbstractController
{
    #[Route('api/participant/{id}', name: 'participant', methods: ['GET'])]
    public function getId(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $participant = $entityManager->getRepository(Participant::class)->find($id);
        if (!$participant) {
            return $this->json(['message' => 'Participant not found'.$id], Response::HTTP_NOT_FOUND);
        }
        return $this->json([
            'id' => $participant->getId(),
            'nom' => $participant->getNom(),
            'prenom' => $participant->getPrenom(),
            'email' => $participant->getEmail(),
            'telephone' => $participant->getTelephone(),
            'dateNaissance' => $participant->getDateNaissance()->format('Y-m-d'),
            'lienPortefolio' => $participant->getLienPortefolio()
        ], Response::HTTP_OK);
    }

    #[Route('api/participant/', name: 'participants', methods: ['GET'])]
    public function getAll(EntityManagerInterface $entityManager): JsonResponse
    {
        $participants = $entityManager->getRepository(Participant::class)->findAll();
        $data = array_map([$this, 'toArray'], $participants);
        return $this->json([$data]);
    }

    #[Route('api/participant/', name: 'participant_create', methods: ['POST'])]
    public function create(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        try {
            if ($entityManager->getRepository(Participant::class)->findOneBy(['email' => $data['email']])) {
                return $this->json(['message' => 'Email already exist'], Response::HTTP_CONFLICT);
            }else{
                $participant = new Participant();
                $participant->setNom($data['nom']);
                $participant->setPrenom($data['prenom']);
                $participant->setEmail($data['email']);
                $participant->setTelephone($data['telephone']);
                $participant->setDateNaissance(new \DateTime($data['dateNaissance']));
                $participant->setLienPortefolio($data['lienPortefolio']);
                $entityManager->persist($participant);
                $entityManager->flush();
                return $this->json(['message' => 'Participant saved successfully'], Response::HTTP_CREATED);
            }
        }catch (\Exception $exception){
            return $this->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('api/participant/edit/{id}', name: 'participant_update', methods: ['PUT'])]
    public function update(EntityManagerInterface $entityManager, int $id,Request $request): JsonResponse
    {
        $participant = $entityManager->getRepository(Participant::class)->find($id);
        if(!$participant){
            return $this->json(['message' => 'Participant not found'.$id], Response::HTTP_NOT_FOUND);
        }else{
            $data = json_decode($request->getContent(), true);
            try {
                $participant->setNom($data['nom']);
                $participant->setPrenom($data['prenom']);
                $participant->setEmail($data['email']);
                $participant->setTelephone($data['telephone']);
                $participant->setDateNaissance(new \DateTime($data['dateNaissance']));
                $participant->setLienPortefolio($data['lienPortefolio']);
                $entityManager->persist($participant);
                $entityManager->flush();
                return $this->json(['message' => 'Participant updated successfully'], Response::HTTP_OK);
            }catch (\Exception $exception){
                return $this->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    #[Route('api/participant/delete/{id}', name: 'participant_delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $participants = $entityManager->getRepository(Participant::class)->findBy($id);
        if(!$participants){
            return $this->json(['message' => 'Participant not found'.$id], Response::HTTP_NOT_FOUND);
        }else{
            $entityManager->remove($participants);
            $entityManager->flush();
            return $this->json(['message' => 'Participant deleted successfully'], Response::HTTP_NO_CONTENT);
        }

    }

    private function toArray(Participant $p): array
    {
        return [
            'id' => $p->getId(),
            'nom' => $p->getNom(),
            'prenom' => $p->getPrenom(),
            'email' => $p->getEmail(),
            'telephone' => $p->getTelephone(),
            'dateNaissance' => $p->getDateNaissance()?->format('Y-m-d'),
            'lienPortefolio' => $p->getLienPortefolio(),
        ];
    }
}
