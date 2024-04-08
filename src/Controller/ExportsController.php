<?php

namespace App\Controller;

use App\Entity\Exports;
use App\Form\ExportsType;
use App\Repository\ExportsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/exports')]
#[IsGranted('ROLE_USER', statusCode: 423)]
class ExportsController extends AbstractController
{
    private const LIMIT = 20;

    public function __construct(private readonly ExportsRepository $exportsRepository)
    {
    }

    #[Route('/', name: 'app_exports_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $form = $this->createFilterForm($request);
        $page = (int) $request->query->get('page', 1);

        return $this->render('exports/index.html.twig', [
            'pager' => $this->createPagerfanta($form, $page),
            'filter' => $form
        ]);
    }

    private function createFilterForm(Request $request)
    {
        $form = $this->createForm(
            ExportsType::class,
            null,
            [
                'action' => $this->generateUrl('app_exports_index'),
                'method' => 'GET',
            ]
        );
        $form->handleRequest($request);

        return $form;
    }

    private function createPagerfanta(FormInterface $form, int $page): Pagerfanta
    {
        $exports = $this->exportsRepository->createQueryBuilderFromForm($form);
        $adapter = new QueryAdapter($exports);
        return Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $page,
            self::LIMIT
        );
    }
}
