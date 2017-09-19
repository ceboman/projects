<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\AtencionDetalle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Atenciondetalle controller.
 *
 * @Route("atenciondetalle")
 */
class AtencionDetalleController extends Controller
{
    /**
     * Lists all atencionDetalle entities.
     *
     * @Route("/", name="atenciondetalle_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $atencionDetalles = $em->getRepository('GestionBundle:AtencionDetalle')->findAll();

        return $this->render('atenciondetalle/index.html.twig', array(
            'atencionDetalles' => $atencionDetalles,
        ));
    }

    /**
     * Creates a new atencionDetalle entity.
     *
     * @Route("/new", name="atenciondetalle_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $atencionDetalle = new Atenciondetalle();
        $form = $this->createForm('GestionBundle\Form\AtencionDetalleType', $atencionDetalle);
        $form->handleRequest($request);

        $usuarioCreacion = $this->getUser();
        $atencionDetalle->setUsuarioCreacion($usuarioCreacion);

        $usuarioActualizacion = $this->getUser();
        $atencionDetalle->setUsuarioActualizacion($usuarioActualizacion);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atencionDetalle);
            $em->flush();

            return $this->redirectToRoute('atenciondetalle_show', array('idAtencionDetalle' => $atencionDetalle->getIdatenciondetalle()));
        }

        return $this->render('atenciondetalle/new.html.twig', array(
            'atencionDetalle' => $atencionDetalle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a atencionDetalle entity.
     *
     * @Route("/{idAtencionDetalle}", name="atenciondetalle_show")
     * @Method("GET")
     */
    public function showAction(AtencionDetalle $atencionDetalle)
    {
        $deleteForm = $this->createDeleteForm($atencionDetalle);

        return $this->render('atenciondetalle/show.html.twig', array(
            'atencionDetalle' => $atencionDetalle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing atencionDetalle entity.
     *
     * @Route("/{idAtencionDetalle}/edit", name="atenciondetalle_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AtencionDetalle $atencionDetalle)
    {
        $deleteForm = $this->createDeleteForm($atencionDetalle);
        $editForm = $this->createForm('GestionBundle\Form\AtencionDetalleType', $atencionDetalle);
        $editForm->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $atencionDetalle->setUsuarioActualizacion($usuarioActualizacion);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('atenciondetalle_edit', array('idAtencionDetalle' => $atencionDetalle->getIdatenciondetalle()));
        }

        return $this->render('atenciondetalle/edit.html.twig', array(
            'atencionDetalle' => $atencionDetalle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a atencionDetalle entity.
     *
     * @Route("/{idAtencionDetalle}", name="atenciondetalle_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AtencionDetalle $atencionDetalle)
    {
        $form = $this->createDeleteForm($atencionDetalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($atencionDetalle);
            $em->flush();
        }

        return $this->redirectToRoute('atenciondetalle_index');
    }

    /**
     * Creates a form to delete a atencionDetalle entity.
     *
     * @param AtencionDetalle $atencionDetalle The atencionDetalle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AtencionDetalle $atencionDetalle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('atenciondetalle_delete', array('idAtencionDetalle' => $atencionDetalle->getIdatenciondetalle())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
