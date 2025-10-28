<?php

declare(strict_types=1);

namespace UserInterface\Http\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReactAppController extends AbstractController
{
    #[Route('/', name: 'react_app', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('react_app.html.twig');
    }

    #[Route('/app', name: 'react_app_alt', methods: ['GET'])]
    public function app(): Response
    {
        return $this->render('react_app.html.twig');
    }
}
