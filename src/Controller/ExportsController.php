<?php

namespace App\Controller;

use App\Entity\Exports;
use App\Form\ExportsType;
use App\Repository\ExportsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/exports')]
#[IsGranted('ROLE_USER', statusCode: 423)]
class ExportsController extends AbstractController
{
    #[Route('/', name: 'app_exports_index', methods: ['GET'])]
    public function index(ExportsRepository $exportsRepository): Response
    {
        return $this->render('exports/index.html.twig', [
            'exports' => $exportsRepository->findAll(),
        ]);
    }
}
