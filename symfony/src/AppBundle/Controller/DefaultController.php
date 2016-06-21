<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
    * @Route("/hello/{name}", name="hello_route")
    */
    public function helloAction(Request $request, $name){
      return $this->render("default/hello.html.twig", array("name"=>$name));
    }
}
