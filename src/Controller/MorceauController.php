<?php

namespace App\Controller;

use App\Entity\Morceau;
use App\Form\MorceauType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MorceauController extends AbstractController
{
    /**
     * @Route("/morceau", name="morceau")
     */
    public function index()
    {
        $data = $this->getDoctrine()->getRepository(Morceau::class)->findAll();
        return $this->render('morceau/index.html.twig', [
            'data' => $data,
        ]);
    }

    /**
     * @Route("/morceau/add", name="ajouter_morceau")
     */
    public function addAction(Request $request)
    {
        //https://symfony.com/doc/current/best_practices/forms.html

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
     * @Route("/morceau/remove/{id}", name="supprimer_artiste")
     */
    public function removeAction(Request $request, $id)
    {
        // find object artiste
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
}
