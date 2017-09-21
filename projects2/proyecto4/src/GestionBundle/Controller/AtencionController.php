<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Atencion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Atencion controller.
 *
 * @Route("atencion")
 */
class AtencionController extends Controller
{
    /**
     * Lists all atencion entities.
     *
     * @Route("/", name="atencion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $atencions = $em->getRepository('GestionBundle:Atencion')->findAll();

        return $this->render('atencion/index.html.twig', array(
            'atencions' => $atencions,
        ));
    }

    /**
     * Creates a new atencion entity.
     *
     * @Route("/new", name="atencion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $atencion = new Atencion();
        $form = $this->createForm('GestionBundle\Form\AtencionType', $atencion);
        $form->handleRequest($request);

        $usuarioCreacion = $this->getUser();
        $atencion->setUsuarioCreacion($usuarioCreacion);

        $usuarioActualizacion = $this->getUser();
        $atencion->setUsuarioActualizacion($usuarioActualizacion);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atencion);
            $em->flush();

            return $this->redirectToRoute('atencion_show', array('idAtencion' => $atencion->getIdatencion()));
        }

        return $this->render('atencion/new.html.twig', array(
            'atencion' => $atencion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a atencion entity.
     *
     * @Route("/{idAtencion}", name="atencion_show")
     * @Method("GET")
     */
    public function showAction(Atencion $atencion)
    {
        $deleteForm = $this->createDeleteForm($atencion);

        return $this->render('atencion/show.html.twig', array(
            'atencion' => $atencion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing atencion entity.
     *
     * @Route("/{idAtencion}/edit", name="atencion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Atencion $atencion)
    {
        $deleteForm = $this->createDeleteForm($atencion);
        $editForm = $this->createForm('GestionBundle\Form\AtencionType', $atencion);
        $editForm->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $atencion->setUsuarioActualizacion($usuarioActualizacion);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('atencion_edit', array('idAtencion' => $atencion->getIdatencion()));
        }

        return $this->render('atencion/edit.html.twig', array(
            'atencion' => $atencion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a atencion entity.
     *
     * @Route("/{idAtencion}", name="atencion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Atencion $atencion)
    {
        $form = $this->createDeleteForm($atencion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($atencion);
            $em->flush();
        }

        return $this->redirectToRoute('atencion_index');
    }

    /**
     * Creates a form to delete a atencion entity.
     *
     * @param Atencion $atencion The atencion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Atencion $atencion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('atencion_delete', array('idAtencion' => $atencion->getIdatencion())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
