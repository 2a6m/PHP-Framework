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
        return new Response(
            '<html><body>Hello '.$name.'</body></html>'
          );
    }

    public function indexAction(Request $request)
    {
      // retrieve GET and POST variables respectively
      $name = $request->query->get('page');
      $name = $request->request->get('page');
    }
}
