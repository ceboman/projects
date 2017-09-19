<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\EstadoAtencion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Estadoatencion controller.
 *
 * @Route("estadoatencion")
 */
class EstadoAtencionController extends Controller
{
    /**
     * Lists all estadoAtencion entities.
     *
     * @Route("/", name="estadoatencion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $estadoAtencions = $em->getRepository('GestionBundle:EstadoAtencion')->findAll();

        return $this->render('estadoatencion/index.html.twig', array(
            'estadoAtencions' => $estadoAtencions,
        ));
    }

    /**
     * Creates a new estadoAtencion entity.
     *
     * @Route("/new", name="estadoatencion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $estadoAtencion = new Estadoatencion();
        $form = $this->createForm('GestionBundle\Form\EstadoAtencionType', $estadoAtencion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estadoAtencion);
            $em->flush();

            return $this->redirectToRoute('estadoatencion_show', array('idEstadoAtencion' => $estadoAtencion->getIdestadoatencion()));
        }

        return $this->render('estadoatencion/new.html.twig', array(
            'estadoAtencion' => $estadoAtencion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a estadoAtencion entity.
     *
     * @Route("/{idEstadoAtencion}", name="estadoatencion_show")
     * @Method("GET")
     */
    public function showAction(EstadoAtencion $estadoAtencion)
    {
        $deleteForm = $this->createDeleteForm($estadoAtencion);

        return $this->render('estadoatencion/show.html.twig', array(
            'estadoAtencion' => $estadoAtencion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing estadoAtencion entity.
     *
     * @Route("/{idEstadoAtencion}/edit", name="estadoatencion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EstadoAtencion $estadoAtencion)
    {
        $deleteForm = $this->createDeleteForm($estadoAtencion);
        $editForm = $this->createForm('GestionBundle\Form\EstadoAtencionType', $estadoAtencion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estadoatencion_edit', array('idEstadoAtencion' => $estadoAtencion->getIdestadoatencion()));
        }

        return $this->render('estadoatencion/edit.html.twig', array(
            'estadoAtencion' => $estadoAtencion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a estadoAtencion entity.
     *
     * @Route("/{idEstadoAtencion}", name="estadoatencion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EstadoAtencion $estadoAtencion)
    {
        $form = $this->createDeleteForm($estadoAtencion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($estadoAtencion);
            $em->flush();
        }

        return $this->redirectToRoute('estadoatencion_index');
    }

    /**
     * Creates a form to delete a estadoAtencion entity.
     *
     * @param EstadoAtencion $estadoAtencion The estadoAtencion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EstadoAtencion $estadoAtencion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('estadoatencion_delete', array('idEstadoAtencion' => $estadoAtencion->getIdestadoatencion())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
