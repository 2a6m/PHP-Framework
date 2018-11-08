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

class MorceauControllerAPI extends AbstractController
{
    /**
     * @Route("/api/morceau", name="api_morceau", methods={"GET"})
     */
    public function index()
    {
        // just setup a fresh $task object (remove the dummy data)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
        {
            $response = new Response();
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');

            return $response;
        }

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $em= $this->getDoctrine()->getManager();
        $data = $em->getRepository(Morceau::class)->findAll();
        $jsonContent = $serializer->serialize($data,'json');

        $response = new JsonResponse();
        $response->setContent($jsonContent);
        return $response;
    }

    /**
     * @Route("/api/morceau/add", name="api_ajouter_morceau", methods={"POST"})
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
        $form = $this->createForm(MorceauType::class, $morceau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // fait quelque chose comme sauvegarder la tache dans la db

                // you can fetch the EntityManager via $this->getDoctrine()
                $em = $this->getDoctrine()->getManager();

                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $em->persist($morceau);

                // actually executes the queries (i.e. the INSERT query)
                $em->flush();

                return new Response ('succes');
            } catch (Exception $e){
                return new Response ('no succes');
            }
        }

        return $this->render('morceau/add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/api/morceau/remove/{id}", name="api_supprimer_morceau", methods={"DELETE"})
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
        $repository = $this->getDoctrine()->getRepository(Morceau::class);
        $morceau = $repository->find($id);

        // delete object artiste in db
        $em = $this->getDoctrine()->getmanager();
        $em->remove($morceau);
        $em->flush();

        return $this->render('morceau/remove.html.twig', [
            'morceau' => $morceau,
        ]);
    }

    /**
     * @Route("/api/morceau/update/{id}", name="api_modifier_morceau", methods={"PUT"})
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
        $repository = $this->getDoctrine()->getRepository(Morceau::class);
        $morceau = $repository->find($id);

        $form = $this->createForm(MorceauType::class, $morceau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // fait quelque chose comme sauvegarder la tache dans la db

                // you can fetch the EntityManager via $this->getDoctrine()
                $em = $this->getDoctrine()->getManager();

                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $em->persist($morceau);

                // actually executes the queries (i.e. the INSERT query)
                $em->flush();

                return new Response ('succes');
            } catch (Exception $e){
                return new Response ('no succes');
            }
        }

        return $this->render('morceau/update.html.twig', array('form' => $form->createView(), 'morceau' => $morceau));
    }
}
