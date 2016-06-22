<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\src\Repository\RencontreRepository;
use AppBundle\Form\RencontreType;
use AppBundle\Form\PronosticType;
use AppBundle\Entity\Pronostic;
use AppBundle\Entity\Pronostics;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PronosticController extends Controller
{

/**
* @Route("/pronostic/nouveau/{idRencontre}", name="pronoctic_nouveau")
* @ParamConverter("rencontre", class="AppBundle:Rencontre", options={"id"="idRencontre"})
*/
public function nouveauAction(Request $request, $rencontre) {

 $user = $this->getUser();

 $em = $this->getDoctrine()->getManager();

 $pronostic = new Pronostic();

 $pronostic->setDate(new \DateTime());
 $pronostic->setRencontre($rencontre);
 $pronostic->setUtilisateur($user);

 $isAdmin = $this->get('security.authorization_checker')
    ->isGranted('ROLE_SUPER_USER');

 $form = $this->createForm(PronosticType::class, $pronostic,
            array('utilisateur_editable' => $isAdmin))
            ->add('submit', SubmitType::class);

 $form->handleRequest($request);

 if ($form->isSubmitted() && $form->isValid()) {
   $em->persist($pronostic);
   $em->flush();
   // return $this->generateUrl("rencontreModifier", array('id' => $id));
 }

 return $this->render("rencontre/pronostic.html.twig",
                  array("form" => $form->createView()));
}

/**
* @Route("/pronostic/liste/{idRencontre}", name="pronoctic_liste")
* @ParamConverter("rencontre", class="AppBundle:Rencontre", options={"id"="idRencontre"})
*/
public function listeAction(Request $request, $rencontre) {

 // $em = $this->getDoctrine()->getManager();

 // $repository = $this->getDoctrine()->getRepository("AppBundle:Pronostic");

 // $pronostics = $repository->findBy(array("rencontre" => $rencontre->getId()));

  $pronostics = $rencontre->getPronostics();

  return $this->render("rencontre/pronostics.html.twig", array("pronostics" => $pronostics, "rencontre" => $rencontre));
}

}
