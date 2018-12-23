<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use \DateTime;

class ArtisteControllerAPI extends AbstractController
{
    /**
     * @Route("/api/artiste", name="api_artiste", methods={"GET"})
     */
    public function index()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $em= $this->getDoctrine()->getManager();
        $data = $em->getRepository(Artiste::class)->findAll();
        $jsonContent = $serializer->serialize($data,'json');

        $response = new JsonResponse();
        $response->setContent($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setStatusCode('200');

        return $response;
    }

    /**
     * @Route("/api/artiste/add", name="api_ajouter_artiste", methods={"OPTIONS","POST"})
     */
    public function addAction(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
        {
            $response = new Response();
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');

            return $response;
        }

        $artiste = new Artiste();

        $json = $request->getContent();
        $content = json_decode($json, true);

        $artiste->setNom($content["nom"]);
        $artiste->setDateNaissance(DateTime::createFromFormat("Y/m/d",$content["date_naissance"]));
        $artiste->setGenre($content["genre"]);

        if (!$artiste) {
            $response = new Response("Error: time creation aborted !");
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->setStatusCode('200');

            return $response;
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artiste);
            $em->flush();

            $response = new Response("The artist has been successfully added !");
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->setStatusCode('200');

            return $response;
        }
    }

    /**
     * @Route("/api/artiste/remove/{id}", name="api_supprimer_artiste", methods={"OPTIONS","DELETE"})
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
        $artiste = $em->getRepository(Artiste::class)->find($id);

        // delete object artiste in db
        if (!$artiste) {
          throw $this->createNotFoundException(
              'No song found for this id '.$id
            );
          }

        $em->remove($artiste);
        $em->flush();

        $response = new Response("The artist was successfully deleted !");
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setStatusCode('200');

        return $response;
    }

    /**
     * @Route("/api/artiste/update/{id}", name="api_modifier_artiste", methods={"OPTIONS","PUT"})
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

        // find object morceau
        $em = $this->getDoctrine()->getManager();
        $artiste = $em->getRepository(Artiste::class)->find($id);

        $artiste->setNom($content["nom"]);
        $artiste->setDateNaissance(DateTime::createFromFormat("Y/m/d",$content["date_naissance"]));
        $artiste->setGenre($content["genre"]);

        if (!$artiste) {
            return new Response("Error: time creation aborted !");
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artiste);
            $em->flush();

            $response = new Response("The artist has been successfully added !");
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->setStatusCode('200');

            return $response;
        }
    }
}
