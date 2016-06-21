<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\src\Repository\RencontreRepository;
use AppBundle\Form\RencontreType;

class RencontreController extends Controller
{
    /*
    * @Route("/rencontre", name="rencontre_index")

   public function indexAction() {

     $repository = $this->getDoctrine()->getRepository("AppBundle:Rencontre");

     $rencontres = $repository->findAll();

     return $this->render("rencontre/rencontre.html.twig", array("rencontres" => $rencontres));

   }

   @Route("/rencontre", name="rencontre_index")

  public function indexAction() {

    $repository = $this->getDoctrine()->getRepository("AppBundle:Rencontre");

    $equipe = "France";

    $rencontresA = $repository->findBy(array("equipeA" => $equipe), array("date" => "ASC"));

    $rencontresB = $repository->findBy(array("equipeB" => $equipe), array("date" => "ASC"));

    return $this->render("rencontre/rencontre.html.twig", array("rencontresA" => $rencontresA, "rencontresB" => $rencontresB));

  }
  */

  /*
  * @Route("/equipe/{nom}", name="rencontre_equipe")

 public function indexAction(Request $request, $nom) {

   $repository = $this->getDoctrine()->getRepository("AppBundle:Rencontre");

   $rencontres = $repository->findBy(array("equipeA" => $nom), array("date" => "ASC"));

   return $this->render("rencontre/equipe.html.twig", array("rencontres" => $rencontres, "nom" => $nom));

 }
 */

 /*
 * @Route("/equipe/{nom}", name="rencontre_equipe")

public function indexAction(Request $request, $nom) {

  $repository = $this->getDoctrine()->getRepository("AppBundle:Rencontre");

  $rencontres = $repository->getRencontreByEquipe($nom);

  return $this->render("rencontre/equipe.html.twig", array("rencontres" => $rencontres, "nom" => $nom));

}
*/

/**
* @Route("/rencontre/{id}", name="rencontre_modifier")
*/
public function modifierAction(Request $request, $id) {

 $repository = $this->getDoctrine()->getRepository("AppBundle:Rencontre");

 $rencontres = $repository->find($id);

 $form = $this->createForm(new RencontreType(), $rencontres);

 $form->handleRequest($request);

 if ($form->isSubmitted() && $form->isValid()) {
   $this->getDoctrine()->getManager()->flush();
   // return $this->generateUrl("rencontreModifier", array('id' => $id));
 }

 return $this->render("rencontre/rencontre.html.twig",
                  array("rencontres" => $rencontres,
                  "form" => $form->createView()));
}

}
