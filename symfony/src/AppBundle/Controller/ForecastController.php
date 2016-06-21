<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\PronosticType;
use AppBundle\Entity\Pronostic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
class ForecastController extends Controller
{
    /**
     * @Route("/match/pronostic/{idRencontre}", name="pronostic_route")
     *@ParamConverter("rencontre", class="AppBundle:Rencontre", options={"id" = "idRencontre"})
     */
    public function pronosticAction(Request $request, $rencontre)
    {
        //$repository = $this->getRepositoryRencontre();
        //$rencontre  = $repository->find($idRencontre);

        $pronostic  = new Pronostic();
        $pronostic->setRencontre($rencontre);
        $pronostic->setDate(new \DateTime());
        $form = $this->createForm(PronosticType::class, $pronostic);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pronostic);
            $em->flush();
            return $this->redirectToRoute('pronostic_route', array(
                'idRencontre' => $rencontre->getId()
            ));
        }
        return $this->render("forecast/forecast.html.twig", array(
            "rencontre" => $rencontre,
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/match/pronostic/list/{idRencontre}", name="list_route")
     *@ParamConverter("rencontre", class="AppBundle:Rencontre", options={"id" = "idRencontre"})
     */
    public function listAction(Request $request, $rencontre)
    {
      //$repository = $this->getRepository();
      //$pronostics    = $repository->getPronosticsByRencontre($idRencontre);
      $pronostics = $rencontre->getPronostics();

        return $this->render("forecast/list.html.twig", array(
            "pronostics" => $pronostics
        ));
    }

    /**
     * @Route("/match/pronostic/nontermines/list", name="nontermines_route")
     *
     */
    public function nonTerminesAction(Request $request)
    {
      $repository = $this->getRepository();
      $pronostics    = $repository->getPronosticsMatchsNonTermines();


        return $this->render("forecast/nontermines.html.twig", array(
            "pronostics" => $pronostics
        ));
    }


    public function getRepositoryRencontre()
    {
        return $this->getDoctrine()->getRepository("AppBundle:Rencontre");
    }

    public function getRepository()
    {
        return $this->getDoctrine()->getRepository("AppBundle:Pronostic");
    }
}
