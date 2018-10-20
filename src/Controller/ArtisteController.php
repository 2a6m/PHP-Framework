<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function addAction()
    {
      $form = $this->createForm(MorceauType::class, new User());
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->valid()) {
        // fait quelque chose comme sauvegarder la tache dans la db

        return $this->redirect($this->generateUrl('add_succes'));
      }

      return $this->render('artiste/add.html.twig', array('form' => $form->createView()));
    }
}
