<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MorceauController extends AbstractController
{
    /**
     * @Route("/morceau", name="morceau")
     */
    public function index()
    {
        return $this->render('morceau/index.html.twig', [
            'controller_name' => 'MorceauController',
        ]);
    }

    public function addAction()
    {
      $form = $this->createForm(MorceauType::class, new User());
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->valid()) {
        // fait quelque chose comme sauvegarder la tache dans la db

        return $this->redirect($this->generateUrl('add_succes'));
      }

      return $this->render('add.html.twig', array('form' => $form->createView()));
    }
}
