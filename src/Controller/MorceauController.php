<?php

namespace App\Controller;

use App\Entity\Morceau;
use App\Form\MorceauType;
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

    /**
     * @Route("/morceau/add", name="ajouter_morceau")
     */
    public function addAction()
    {
      //https://symfony.com/doc/current/best_practices/forms.html

      $form = $this->createForm(MorceauType::class, new Morceau());
      //$form->handleRequest($request);

      if ($form->isSubmitted() && $form->valid()) {
        // fait quelque chose comme sauvegarder la tache dans la db

        return $this->redirect($this->generateUrl('add_succes'));
      }

      return $this->render('morceau/add.html.twig', array('form' => $form->createView()));
    }
}
