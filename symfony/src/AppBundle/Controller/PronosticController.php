<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\PronosticType;
use AppBundle\Entity\Pronostic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Rencontre;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PronosticController extends Controller
{

      /**
      * @Route("/pronostic/nouveau/{idRencontre}",name="Pronostic_ajouter")
      * @ParamConverter("rencontre", class="AppBundle:Rencontre", options={"id" = "idRencontre"})
      *
      */
      public function NouveauAction(Request $request,Rencontre $rencontre ){
        $m= $this->getDoctrine()->GetManager();
        $Pronostic = new Pronostic();
        $Pronostic->setDate(new \DateTime());
        $Pronostic->setRencontre($rencontre);
        $repository = $this->getRepository();
        //$form= $this->createForm(new PronosticType(),$Pronostic);
        $form= $this->createForm(PronosticType::class, $Pronostic)->add('submit', SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() &&   $form->isValid()){
          $m->persist($Pronostic);
          $m->flush();
          return $this->redirectToRoute('rencontre_index');
        }
        return  $this->render ("pronostic/ajouter.html.twig",array('form'=> $form->createView()));
      }
      public function getRepository(){
        return $this->getDoctrine()->getRepository("AppBundle:Pronostic");
      }
      /**
      * @Route("/pronostic/liste",name="pronostic_index")
      */
      public function indexAction(Request $request ){
        $repository = $this->getDoctrine()->getRepository("AppBundle:Pronostic");
        $items= $repository->findall();
        return  $this->render ("pronostic/liste.html.twig",array( "items" => $items));
      }

}
