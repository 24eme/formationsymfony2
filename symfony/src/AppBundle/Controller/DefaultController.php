<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
  /*
  * @Route("/hello",name="hello")
 public function helloAction() {
   return new $Response("Bonjour");
 }
 */

     /*
     * @Route("/hello",name="hello")
    public function helloAction(Request $request) {
      $nom = $request->get("nom");
      return new Response("Bonjour ".$nom. " !");
    }
     */

     /**
     * @Route("/hello/{nom}",name="hello")
    public function helloAction($nom) {
      return new Response("Bonjour ".$nom. " !");
    }
    */

    /**
    * @Route("/hello/{nom}",name="hello")
    */
   public function helloAction($nom) {
     return $this->render("default/bonjour.html.twig", array("nom" => $nom));
   }

}
