<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DemoController extends Controller
{
    /**
     * @Route("/demo/hello")
     */
    public function helloAction()
    {
        $name = 'Peter';

        return new Response(
            '<html><body>Hello '.$name.'</body></html>'
          );
    }
}
