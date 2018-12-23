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

        return $response;
    }

    /**
     * @Route("/api/artiste/add", name="api_ajouter_artiste", methods={"GET","OPTIONS","POST"})
     */
    public function addAction(Request $request)
    {
        $response = new Response();
        $query = array();

        // just setup a fresh $task object (remove the dummy data)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
        {
            $response->headers->set('Content-Type', 'application/text');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type', true);

            return $response;
        }

        $artiste = new Artiste();

        $json = $request->getContent();
        $content = json_decode($json, true);

        $artiste->setNom($content["nom"]);
        $artiste->setDateNaissance(DateTime::createFromFormat("Y-m-d",$content["dateNaissance"]));
        $artiste->setGenre($content["genre"]);

        if (!$artiste) {
            $response->setStatusCode('404');
            $query['status'] = false;
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artiste);
            $em->flush();

            $response->setStatusCode(200);
            $query['status'] = true;
        }
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($query));

        return $response;
    }

    /**
     * @Route("/api/artiste/remove/{id}", name="api_supprimer_artiste", methods={"GET", "OPTIONS","DELETE"})
     */
    public function removeAction(Request $request, $id)
    {
        $response = new Response();
        $query = array();

        // just setup a fresh $task object (remove the dummy data)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
        {
            $response->headers->set('Content-Type', 'application/text');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type',true);

            return $response;
        }

        // delete object artiste in db
        if (!$id) {
            $response->setStatusCode('404');
            $query['status'] = false;
        }
        else {
            $entityManager = $this->getDoctrine()->getManager();
            $artiste = $entityManager->getRepository(Artiste::class)->find($id);

            $entityManager->remove($artiste);
            $entityManager->flush();

            $response->setStatusCode('200');
            $query['status'] = true;
        }
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($query));
        return $response;
    }

    /**
     * @Route("/api/artiste/update/{id}", name="api_modifier_artiste", methods={"OPTIONS","PUT"})
     */
    public function updateAction(Request $request, $id)
    {
        $response = new Response();
        $query = array();

        // just setup a fresh $task object (remove the dummy data)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
        {
            $response->headers->set('Content-Type', 'application/text');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type',true);

            return $response;
        }

        // find object morceau
        $json = $request->getContent();
        $content = json_decode($json, true);

        // find object morceau
        $em = $this->getDoctrine()->getManager();
        $artiste = $em->getRepository(Artiste::class)->find($id);

        $artiste->setNom($content["nom"]);
        $artiste->setDateNaissance(DateTime::createFromFormat("Y-m-d",$content["dateNaissance"]));
        $artiste->setGenre($content["genre"]);

        if (!$artiste) {
            $response->setStatusCode('404');
            $query['status'] = false;
        }
        else {
            $em->persist($artiste);
            $em->flush();

            $response->setStatusCode('200');
            $query['status'] = true;
        }
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($query));
        return $response;
    }
}
