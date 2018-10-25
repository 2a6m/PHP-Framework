<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArtisteController extends AbstractController
{
    /**
     * @Route("/artiste", name="artiste")
     */
    public function index()
    {
        return $this->render('artiste/index.html.twig', [
            'controller_name' => 'ArtisteController',
        ]);
    }

    /**
     * @Route("/artiste/add", name="ajouter_artiste")
     */
    public function addAction(Request $request)
    {

        $artist = new Artiste();
        $form = $this->createForm(ArtisteType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // fait quelque chose comme sauvegarder la tache dans la db

                // you can fetch the EntityManager via $this->getDoctrine()
                $em = $this->getDoctrine()->getManager();

                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $em->persist($artist);

                // actually executes the queries (i.e. the INSERT query)
                $em->flush();

                return new Response ('succes');
            } catch (Exception $e){
                return new Response ('no succes');
            }
      }

      return $this->render('artiste/add.html.twig', array('form' => $form->createView()));
    }
}
