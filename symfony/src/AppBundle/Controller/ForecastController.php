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

        // Il faut setter le champ utilisateur
        $user = $this->getUser();
        $pronostic->setUtilisateur($user);

        $isAdmin = $this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN');

        $form = $this->createForm(PronosticType::class, $pronostic, array('utilisateur_editable'=>$isAdmin));
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

    /**
     * @Route("/match/pronostic/tableau/whoisthebest", name="whoisthebest_route")
     */
    public function whoIsTheBestAction(Request $request){
      $userRepo = $this->getRepositoryUser();
      $users = $userRepo->findBy(array(), array("nbCafesGagnes"=>"ASC"));
      return $this->render("forecast/whoIsTheBest.html.twig", array(

      ));
    }


    public function getRepositoryRencontre()
    {
        return $this->getDoctrine()->getRepository("AppBundle:Rencontre");
    }

    public function getRepositoryUser()
    {
        return $this->getDoctrine()->getRepository("AppBundle:User");
    }

    public function getRepository()
    {
        return $this->getDoctrine()->getRepository("AppBundle:Pronostic");
    }
}
