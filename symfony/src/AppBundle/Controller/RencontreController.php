<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\RencontreType;

class RencontreController extends Controller
{


    /**
    * @Route("/", name="rencontre_index")
    */
    public function indexAction(Request $request) {
      $date = new \DateTime();

      $repository = $this->getDoctrine()->getRepository("AppBundle:Rencontre");

      $rencontres = $repository->findBy(array(), array('date' => 'DESC'));
      return $this->render("rencontre/index.html.twig", array('rencontres' => $rencontres));
    }

    /**
    * @Route("/equipe/{nom}", name="rencontre_equipe")
    */
    public function equipeAction(Request $request, $nom) {
      $repository = $this->getRepository();

      $rencontres = $repository->findBy(array('equipeA' => $nom), array('date' => 'DESC'));
      $rencontres = $repository->getRencontresByEquipeAlt($nom);

      return $this->render("rencontre/equipe.html.twig", array('rencontres' => $rencontres, 'nom' => $nom));
    }

    /**
    * @Route("/equipe/modifier/{id}", name="rencontre_modifier")
    */
    public function modifierAction(Request $request, $id) {
      $repository = $this->getRepository();

      $rencontre = $repository->find($id);

      $form = $this->createForm(new RencontreType(), $rencontre);
      //  var_dump($_POST);
      $form->handleRequest($request);
      //$this->denyAccessUnlessGranted('ROLE_ADMIN'); PLUS RAPIDE
      if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
      {
      if($form->isSubmitted() && $form->isValid())

          {

            $this->getDoctrine()->getManager()->flush();
            return $this->RedirectToRoute('rencontre_modifier', array('id'=>$id));
          }

          return $this->render("rencontre/modifier.html.twig",
              array('rencontre' => $rencontre,
                    'form' => $form->createView())
              );
            }
        else {
          throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
        }
    }


    public function getRepository()  {
      return $this->getDoctrine()->getRepository("AppBundle:Rencontre");
    }
}
