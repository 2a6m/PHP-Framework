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
        $data = $this->getDoctrine()->getRepository(Artiste::class)->findAll();
        return $this->render('artiste/index.html.twig', [
            'data' => $data,
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

    /**
     * @Route("/artiste/remove/{id}", name="supprimer_artiste")
     */
    public function removeAction(Request $request, $id)
    {
        // find object artiste
        $repository = $this->getDoctrine()->getRepository(Artiste::class);
        $artiste = $repository->find($id);

        // delete object artiste in db
        $em = $this->getDoctrine()->getmanager();
        $em->remove($artiste);
        $em->flush();

        return $this->render('artiste/remove.html.twig', [
            'artiste' => $artiste,
        ]);
    }

    /**
     * @Route("/artiste/update/{id}", name="modifier_artiste")
     */
    public function updateAction(Request $request, $id)
    {
        return new Response ($id);
        /*
        return $this->render('artiste/update.html.twig', [
            'method_name' => 'artiste update_action',
        ]);
        */
    }
}
