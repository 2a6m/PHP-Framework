<?php

namespace App\Controller;

use App\Entity\Morceau;
use App\Form\MorceauType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use \DateTime;

class MorceauControllerAPI extends AbstractController
{
    /**
     * @Route("/api/morceau", name="api_morceau", methods={"GET"})
     */
    public function index()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $em= $this->getDoctrine()->getManager();
        $data = $em->getRepository(Morceau::class)->findAll();
        $jsonContent = $serializer->serialize($data,'json');

        $response = new JsonResponse();
        $response->setContent($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setStatusCode('200');

        return $response;
    }

    /**
     * @Route("/api/morceau/add", name="api_ajouter_morceau", methods={"OPTIONS","POST"})
     */
    public function addAction(Request $request)
    {
        //https://symfony.com/doc/current/best_practices/forms.html

        // just setup a fresh $task object (remove the dummy data)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
        {
            $response = new Response();
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');

            return $response;
        }

        $morceau = new Morceau();

        $json = $request->getContent();
        $content = json_decode($json, true);

        $morceau->setTitre($content["titre"]);
        $morceau->setDuree(DateTime::createFromFormat("i:s",$content["duree"]));
        $morceau->setGenre($content["genre"]);

        $em = $this->getDoctrine()->getManager();
        $artiste = $em->getRepository(Morceau::class)->find($content["artiste"]);
        $morceau->setArtiste($artiste);

        $morceau->setDate(DateTime::createFromFormat("Y/m/d",$content["date"]));

        if (!$morceau) {
            $response = new Response("Error: time creation aborted !");
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->setStatusCode('200');

            return $response;
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($morceau);
            $em->flush();
            $response = new Response("The song has been successfully added !");
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->setStatusCode('200');

            return $response;
        }
    }

    /**
     * @Route("/api/morceau/remove/{id}", name="api_supprimer_morceau", methods={"OPTIONS","DELETE"})
     */
    public function removeAction(Request $request, $id)
    {
        // just setup a fresh $task object (remove the dummy data)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
        {
            $response = new Response();
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');

            return $response;
        }

        // find object morceau
        $em = $this->getDoctrine()->getManager();
        $morceau = $em->getRepository(Morceau::class)->find($id);

        // delete object artiste in db
        if (!$morceau) {
          throw $this->createNotFoundException(
              'No song found for this id '.$id
            );
          }

        $em->remove($morceau);
        $em->flush();
        $response = new Response("The song was successfully deleted !");
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setStatusCode('200');

        return $response;
    }

    /**
     * @Route("/api/morceau/update/{id}", name="api_modifier_morceau", methods={"OPTIONS","PUT"})
     */
    public function updateAction(Request $request, $id)
    {
        // just setup a fresh $task object (remove the dummy data)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
        {
            $response = new Response();
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');

            return $response;
        }

        // find object morceau
        $json = $request->getContent();
        $content = json_decode($json, true);

        $em = $this->getDoctrine()->getManager();
        $morceau = $em->getRepository(Morceau::class)->find($id);

        $morceau->setTitre($content["titre"]);
        $morceau->setDuree(DateTime::createFromFormat("i:s",$content["duree"]));
        $morceau->setGenre($content["genre"]);

        $em = $this->getDoctrine()->getManager();
        $artiste = $em->getRepository(Morceau::class)->find($content["artiste"]);
        $morceau->setArtiste($artiste);

        $morceau->setDate(DateTime::createFromFormat("Y/m/d",$content["date"]));

        if (!$morceau) {
            $response = new Response("Error: time creation aborted !");
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->setStatusCode('200');

            return $response;
        }
        else {
            $em->persist($morceau);
            $em->flush();

            $response = new Response("The song has been successfully updated !");
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->setStatusCode('200');

            return $response;
        }
    }
}
