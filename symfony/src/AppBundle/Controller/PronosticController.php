<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\PronosticType;
use AppBundle\Entity\Pronostic;
use AppBundle\Entity\Rencontre;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PronosticController extends Controller
{


    /**
    * @Route("/pronostic/nouveau/{idRencontre}", name="pronostic_nouveau")
    * @ParamConverter("rencontre", class="AppBundle:Rencontre", options={"id" = "idRencontre"})
    */

    public function nouveauAction(Request $request, Rencontre $rencontre) {
      $m = $this->getDoctrine()->getManager();

      $pronostic = new Pronostic();
      $pronostic->setDate(new \DateTime());
      $pronostic->setRencontre($rencontre);
      $pronostic->setUtilisateur($this->getUser());

      $isAdmin = $this->get('security.authorization_checker')
                      ->isGranted('ROLE_SUPER_ADMIN');

      $form = $this->createForm(PronosticType::class, $pronostic,
                    array('utilisateur_editable' => $isAdmin))
                   ->add('submit', SubmitType::class);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()) {
        $m->persist($pronostic);
        $m->flush();

        return $this->redirectToRoute('rencontre_index');
      }

      return $this->render("pronostic/nouveau.html.twig", array('form' => $form->createView(), 'rencontre' => $rencontre));
    }

    /**
    * @Route("/pronostic/rencontre/{idRencontre}", name="pronostic_rencontre")
    * @ParamConverter("rencontre", class="AppBundle:Rencontre", options={"id" = "idRencontre"})
    */
    public function rencontreAction(Request $request, Rencontre $rencontre) {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Pronostic');
        $pronostics  = $repository->findBy(array('rencontre' => $rencontre->getId()), array('date' => 'ASC'));

        return $this->render('pronostic/match.html.twig', array('pronostics' => $pronostics, 'rencontre' => $rencontre));
    }

    /**
    * @Route("/pronostic/encours", name="pronostic_encours")
    */
    public function encoursAction(Request $request) {
        $repository = $this->getDoctrine()
                            ->getRepository('AppBundle:Pronostic');
        $pronostics  = $repository->getPronosticsEncours();

        return $this->render('pronostic/list.html.twig', array('pronostics' => $pronostics));
    }

}
