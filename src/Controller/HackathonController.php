<?php

namespace App\Controller;

use App\Entity\Hackathon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HackathonController extends AbstractController
{
    #[Route('/api/html/hackathon/{id}', name: 'html_hackathon')]
    public function hackathon(EntityManagerInterface $entityManager, int $id): Response
    {
        $hackathon = $entityManager->getRepository(Hackathon::class)->find($id);

        if (!$hackathon) {
            throw $this->createNotFoundException(
                'No hackathon found for id '.$id
            );
        }

        return new Response(
            '<html lang="fr"><body>Hackathon: '.$hackathon->getId().', '.$hackathon->getLieu().', '.date_format($hackathon->getDateHeureDebut(),'d/m/Y H:i:s').'</body></html>'
        );
    }

    #[Route('/api/json/hackathon/{id}', name: 'json_hackathon')]
    public function index(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $hackathon = $entityManager->getRepository(Hackathon::class)->find($id);

        if (!$hackathon) {
            throw $this->createNotFoundException(
                'No hackathon found for id '.$id
            );
        }

        return $this->json(
            ['id' => $hackathon->getId(),
            'dateHeureDebut'=>$hackathon->getDateHeureDebut()->format('d/m/Y H:i:s'),
                'dateHeureFin'=>$hackathon->getDateHeureFin()->format('d/m/Y H:i:s'),
                'lieu'=>$hackathon->getLieu(),
                'ville'=>$hackathon->getVille(),
                'theme'=>$hackathon->getTheme(),
                'affiche'=>$hackathon->getAffiche(),
                'objectifs'=>$hackathon->getObjectifs(),
                'organisateurs'=>$hackathon->getOrganisateur()->getId(),
            ]);
    }
}
