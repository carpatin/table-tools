<?php

namespace Carpatin\TableTools\Controller;

use Carpatin\TableTools\Command\CommandProcessorLocator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/table-tools')]
final class ToolsController extends AbstractController
{
    #[Route('/prepend-header', name: 'table_tools_prepend_header', methods: ['POST'])]
    public function prependHeader(CommandProcessorLocator $locator): Response
    {
        // TODO

        return new Response('TO BE DONE');
    }

    #[Route('/merge', name: 'table_tools_merge', methods: ['POST'])]
    public function mergeTables(CommandProcessorLocator $locator): Response
    {
        // TODO

        return new Response('TO BE DONE');
    }
}
