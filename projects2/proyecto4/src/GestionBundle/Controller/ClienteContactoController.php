<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\ClienteContacto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Clientecontacto controller.
 *
 * @Route("clientecontacto")
 */
class ClienteContactoController extends Controller
{
    /**
     * Lists all clienteContacto entities.
     *
     * @Route("/", name="clientecontacto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clienteContactos = $em->getRepository('GestionBundle:ClienteContacto')->findAll();

        return $this->render('clientecontacto/index.html.twig', array(
            'clienteContactos' => $clienteContactos,
        ));
    }

    /**
     * Creates a new clienteContacto entity.
     *
     * @Route("/new", name="clientecontacto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $clienteContacto = new Clientecontacto();
        $form = $this->createForm('GestionBundle\Form\ClienteContactoType', $clienteContacto);
        $form->handleRequest($request);

        $usuarioCreacion = $this->getUser();
        $clienteContacto->setUsuarioCreacion($usuarioCreacion);

        $usuarioActualizacion = $this->getUser();
        $clienteContacto->setUsuarioActualizacion($usuarioActualizacion);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($clienteContacto);
            $em->flush();

            return $this->redirectToRoute('clientecontacto_show', array('idClienteContacto' => $clienteContacto->getIdclientecontacto()));
        }

        return $this->render('clientecontacto/new.html.twig', array(
            'clienteContacto' => $clienteContacto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a clienteContacto entity.
     *
     * @Route("/{idClienteContacto}", name="clientecontacto_show")
     * @Method("GET")
     */
    public function showAction(ClienteContacto $clienteContacto)
    {
        $deleteForm = $this->createDeleteForm($clienteContacto);

        return $this->render('clientecontacto/show.html.twig', array(
            'clienteContacto' => $clienteContacto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing clienteContacto entity.
     *
     * @Route("/{idClienteContacto}/edit", name="clientecontacto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ClienteContacto $clienteContacto)
    {
        $deleteForm = $this->createDeleteForm($clienteContacto);
        $editForm = $this->createForm('GestionBundle\Form\ClienteContactoType', $clienteContacto);
        $editForm->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $clienteContacto->setUsuarioActualizacion($usuarioActualizacion);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clientecontacto_edit', array('idClienteContacto' => $clienteContacto->getIdclientecontacto()));
        }

        return $this->render('clientecontacto/edit.html.twig', array(
            'clienteContacto' => $clienteContacto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a clienteContacto entity.
     *
     * @Route("/{idClienteContacto}", name="clientecontacto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ClienteContacto $clienteContacto)
    {
        $form = $this->createDeleteForm($clienteContacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($clienteContacto);
            $em->flush();
        }

        return $this->redirectToRoute('clientecontacto_index');
    }

    /**
     * Creates a form to delete a clienteContacto entity.
     *
     * @param ClienteContacto $clienteContacto The clienteContacto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ClienteContacto $clienteContacto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clientecontacto_delete', array('idClienteContacto' => $clienteContacto->getIdclientecontacto())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
