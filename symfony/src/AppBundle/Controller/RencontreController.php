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
      * @Route("/",name="rencontre_index")
      */
      public function indexAction(Request $request ){
        $repository = $this->getDoctrine()->getRepository("AppBundle:Rencontre");
        $items= $repository->findall();
        return  $this->render ("rencontre/index.html.twig",array( "items" => $items));
      }
      /**
      * @Route("/equipeA/{equipeA}",name="rencontre_equipeA")
      */
      public function equipeAAction(Request $request,$equipeA ){
        $repository = $this->getDoctrine()->getRepository("AppBundle:Rencontre");
        $items= $repository->findby(array("equipeA"=> $equipeA), array("libelle"=>"DESC") );
        $items= $repository->getRencotresByEquipe($equipeA);

        return  $this->render ("rencontre/equipe.html.twig",array( "items" => $items));
      }
      /**
      * @Route("/equipeB/{equipeB}",name="rencontre_equipeB")
      */
      public function equipeBAction(Request $request,$equipeB ){
        $repository = $this->getDoctrine()->getRepository("AppBundle:Rencontre");
        $items= $repository->findby(array("equipeB"=> $equipeB), array("libelle"=>"DESC") );
        return  $this->render ("rencontre/equipe.html.twig",array( "items" => $items));
      }
      /**
      * @Route("/groupe/{groupe}",name="rencontre_groupe")
      */
      public function groupeAction(Request $request,$groupe ){
        $repository = $this->getDoctrine()->getRepository("AppBundle:Rencontre");
        $items= $repository->findby(array("libelle"=> $groupe), array("libelle"=>"DESC") );
        return  $this->render ("rencontre/groupe.html.twig",array( "items" => $items));
      }
      /**
      * @Route("/equipe/modifier/{id}",name="rencontre_modifier")
      */
      public function modifierAction(Request $request,$id ){
        $repository = $this->getRepository();

        $rencontre= $repository->find($id);
        $form= $this->createForm(new RencontreType(),$rencontre);
        $form->handleRequest($request);

        if($form->isSubmitted() &&   $form->isValid()){
          $this->getDoctrine()->getManager()->flush();
          //return $this->redirect($this->generateUrl('rencontre_modifier',array('id'=>$id)));
          return $this->redirectToRoute('rencontre_modifier',array('id'=>$id));
        }
        return  $this->render ("rencontre/modifier.html.twig",array( "rencontre" => $rencontre ,'form'=> $form->createView()));
      }
      public function getRepository(){
        return $this->getDoctrine()->getRepository("AppBundle:Rencontre");
      }
}
