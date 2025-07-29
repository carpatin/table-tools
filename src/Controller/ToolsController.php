<?php

declare(strict_types=1);

namespace Carpatin\TableTools\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/table-tools')]
final class ToolsController extends AbstractController
{
    #[Route('/prepend-header', name: 'table_tools_prepend_header', methods: ['POST'])]
    public function prependHeader(): Response
    {
        // TODO

        return new Response('TO BE DONE');
    }

    #[Route('/merge', name: 'table_tools_merge', methods: ['POST'])]
    public function mergeTables(): Response
    {
        // TODO

        return new Response('TO BE DONE');
    }
}
