<?php declare(strict_types = 1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class Caris
{
    /**
     * @Route("/caris/show", name="show")
     */
    public function show()
    {
        return new Response('hi');
    }
}