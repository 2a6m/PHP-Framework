<?php

namespace App\Controller;

use App\Entity\Artiste;
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

/*
 *  Controller to propose the API interface for the music's model.
 *  It will return response in json (standardisation of the API's communication).
 *  An CRUD API have 4 methods: Create/POST, Read/GET, Update/PUT, Delete/DELETE (there call in html).
 */
class MorceauControllerAPI extends AbstractController
{
    /*
     *  Method for Read/GET.
     */
    /**
     * @Route("/api/morceau", name="api_morceau", methods={"GET"})
     */
    public function index()
    {
        // Generate a new jsonencoder
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $em= $this->getDoctrine()->getManager();
        // We find all the artist in the db via the ORM
        $data = $em->getRepository(Morceau::class)->findAll();
        // We transform the data into a json format
        $jsonContent = $serializer->serialize($data,'json');

        // Generate a json respond (nb: the API return information in json format)
        $response = new JsonResponse();
        $response->setContent($jsonContent);
        // Add headers to add informations
        $response->headers->set('Content-Type', 'application/json');
        // Allow CORS Cross-Origin Ressource Sharing (nb: it make a request from an another url)
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /*
     *  Method for Create/POST.
     */
    /**
     * @Route("/api/morceau/add", name="api_ajouter_morceau", methods={"GET","OPTIONS","POST"})
     */
    public function addAction(Request $request)
    {
        //https://symfony.com/doc/current/best_practices/forms.html

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

        // Create a new artist with the data received (nb: data on json format in the request)
        $morceau = new Morceau();

        $json = $request->getContent();
        $content = json_decode($json, true);

        $morceau->setTitre($content["titre"]);
        $morceau->setDuree(DateTime::createFromFormat("i:s",$content["duree"]));
        $morceau->setGenre($content["genre"]);

        $em = $this->getDoctrine()->getManager();
        $artiste = $em->getRepository(Artiste::class)->find($content["artiste"]);
        $morceau->setArtiste($artiste);

        $morceau->setDate(DateTime::createFromFormat("Y-m-d",$content["date"]));

        if (!$morceau) {
            // Error, create an 404 error
            $response->setStatusCode('404');
            $query['status'] = false;
        }
        else {
            // save the new artist in the db
            $em = $this->getDoctrine()->getManager();
            $em->persist($morceau);
            $em->flush();

            // create a succes (nb: 200 -> OK)
            $response->setStatusCode(200);
            $query['status'] = true;
        }

        // Add headers and send the response
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($query));

        return $response;
    }

    /*
     *  Method for Delete/DELETE.
     */
    /**
     * @Route("/api/morceau/remove/{id}", name="api_supprimer_morceau", methods={"GET","OPTIONS","DELETE"})
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

        if (!$id) {
            // Error, create an 404 error
            $response->setStatusCode('404');
            $query['status'] = false;
        }
        else {
            // delete the artist from the database
            $em = $this->getDoctrine()->getManager();
            $morceau = $em->getRepository(Morceau::class)->find($id);

            $em->remove($morceau);
            $em->flush();

            // create a succes (nb: 200 -> OK)
            $response->setStatusCode('200');
            $query['status'] = true;
        }
        // Add header and send the response
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($query));
        return $response;
    }

    /*
     *  Method for Update/PUT
     */
    /**
     * @Route("/api/morceau/update/{id}", name="api_modifier_morceau", methods={"OPTIONS","PUT"})
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

        // get data
        $json = $request->getContent();
        $content = json_decode($json, true);

        // find object artist and do modification
        $em = $this->getDoctrine()->getManager();
        $morceau = $em->getRepository(Morceau::class)->find($id);

        $morceau->setTitre($content["titre"]);
        $morceau->setDuree(DateTime::createFromFormat("i:s",$content["duree"]));
        $morceau->setGenre($content["genre"]);

        $em = $this->getDoctrine()->getManager();
        $artiste = $em->getRepository(Artiste::class)->find($content["artiste"]);
        $morceau->setArtiste($artiste);

        $morceau->setDate(DateTime::createFromFormat("Y-m-d",$content["date"]));

        if (!$morceau) {
            // Error, create an 404 error
            $response->setStatusCode('404');
            $query['status'] = false;
        }
        else {
            // save the modification
            $em->persist($morceau);
            $em->flush();

            // create a succes (nb: 200 -> OK)
            $response->setStatusCode('200');
            $query['status'] = true;
        }
        // Add header and send the response
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($query));
        return $response;
    }
}
