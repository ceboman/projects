<?php

namespace AdministracionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        /*$session = new Session();
        $session->set('nombre',$this->getUser());*/
        $session = new Session();
        $session->set('nombre', $this->getUser());
        return $this->render('AdministracionBundle:Default:index.html.twig');
    }

    /**
     * @Route("/users", name="users")
     */
    public function usuariosAction()
    {
        return $this->render('AdministracionBundle:Default:index.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AdministracionBundle:Default:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));

    }
}
