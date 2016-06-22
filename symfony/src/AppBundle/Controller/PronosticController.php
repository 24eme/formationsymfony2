<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\PronosticType;
use AppBundle\Entity\Pronostic;
use AppBundle\Entity\Rencontre;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PronosticController extends Controller
{
    /**
     * @Route("Pronostic/nouveau/{idRencontre}", name="pronostic_nouveau")
     * @ParamConverter("rencontre", class="AppBundle:Rencontre", options={"id" = "idRencontre"})
     */
    public function nouveauAction(Request $request, Rencontre $rencontre)
    {

      $repository = $this->getRepository();
      $pronostic = new Pronostic();
      $pronostic->setRencontre($rencontre);
      $pronostic->setDate(new \DateTime);
      $user = $this->get('security.token_storage')->getToken()->getUser();

      $pronostic->setUtilisateur($user);

      $form = $this->createForm(PronosticType::class,$pronostic);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid())
        {
          $this->getDoctrine()->getManager()->persist($pronostic);
          $this->getDoctrine()->getManager()->flush();
          return $this->RedirectToRoute('pronostic_nouveau', array('idRencontre'=>$rencontre));
        }
        return $this->render('pronostic/nouveau.html.twig', array(
          'form' => $form->createView(),
          'rencontre' => $rencontre
        ));

      }
      public function getRepository()  {
        return $this->getDoctrine()->getRepository("AppBundle:Rencontre");
      }

      /**
       * @Route("Pronostic/liste/{idRencontre}", name="pronostic_liste")
       * @ParamConverter("rencontre", class="AppBundle:Rencontre", options={"id" = "idRencontre"})
       */
      public function listeAction(Request $request, Rencontre $rencontre){

        $repository = $this->getDoctrine()->getRepository("AppBundle:Pronostic");
        $pronostics = $rencontre->getPronostics();
        //$pronostics = $repository->findBy(  array('rencontre' => $rencontre->getId()), array('date' => 'DESC'));
        return $this->render("pronostic/liste.html.twig", array('pronostics' => $pronostics));
      }

      /**
       * @Route("Pronostic/encours", name="pronostic_encours")
       */
      public function nonTermineAction(){

        $repository = $this->getDoctrine()->getRepository("AppBundle:Pronostic");
        $pronostics = $repository->getPronosticsMatchNonTermines();
        //$pronostics = $repository->findBy(  array('rencontre' => $rencontre->getId()), array('date' => 'DESC'));
        return $this->render("pronostic/liste.html.twig", array('pronostics' => $pronostics));
      }
    }
