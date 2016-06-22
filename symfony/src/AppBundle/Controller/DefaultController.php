<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{


    /**
    * @Route("/bonjour/{nom}", name="bonjour")
    *
    */
    public function bonjourAction(Request $request, $nom) {

      $user = $this->get('security.token_storage')->getToken()->getUser();
      return $this->render("default/bonjour.html.twig", array("nom" => $nom,"user"=>$user));
    }

}
