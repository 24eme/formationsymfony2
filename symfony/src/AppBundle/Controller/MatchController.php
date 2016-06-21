<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\RencontreType;
class MatchController extends Controller
{
    /**
     * @Route("/match", name="match_route")
     */
    public function matchAction(Request $request)
    {
        $today      = new \DateTime();
        $repository = $this->getRepository();
        //$entries = $repository->findAll();
        $entries    = $repository->findBy(array(), array(
            'date' => 'ASC'
        ));
        return $this->render("match/match.html.twig", array(
            "today" => $today,
            "entries" => $entries
        ));
    }
    /**
     * @Route("/equipe/{team}", name="equipe_route")
     */
    public function equipeAction(Request $request, $team)
    {
        $repository = $this->getRepository();
        $entries    = $repository->getRencontresByEquipe($team);
        return $this->render("match/team.html.twig", array(
            "team" => $team,
            "entries" => $entries
        ));
    }
    /**
     * @Route("/match/modifier/{id}", name="modifier_route")
     */
    public function modifierAction(Request $request, $id)
    {
        $repository = $this->getRepository();
        $entry      = $repository->find($id);
        $form       = $this->createForm(RencontreType::class, $entry);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            //return $this->redirect($this->generateUrl('modifier_route', array('id'=> $id)));
            return $this->redirectToRoute('modifier_route', array('id'=> $id));
        }
        return $this->render("match/modifier.html.twig", array(
            "entry" => $entry,
            "form" => $form->createView()
        ));
    }
    public function getRepository()
    {
        return $this->getDoctrine()->getRepository("AppBundle:Rencontre");
    }
}
