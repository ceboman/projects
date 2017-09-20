<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Proceso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Proceso controller.
 *
 * @Route("proceso")
 */
class ProcesoController extends Controller
{
    /**
     * Lists all proceso entities.
     *
     * @Route("/", name="proceso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $procesos = $em->getRepository('GestionBundle:Proceso')->findAll();

        return $this->render('proceso/index.html.twig', array(
            'procesos' => $procesos,
        ));
    }

    /**
     * Creates a new proceso entity.
     *
     * @Route("/new", name="proceso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $proceso = new Proceso();
        $form = $this->createForm('GestionBundle\Form\ProcesoType', $proceso);
        $form->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $proceso->setUsuarioActualizacion($usuarioActualizacion);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proceso);
            $em->flush();

            return $this->redirectToRoute('proceso_show', array('idProceso' => $proceso->getIdproceso()));
        }

        return $this->render('proceso/new.html.twig', array(
            'proceso' => $proceso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a proceso entity.
     *
     * @Route("/{idProceso}", name="proceso_show")
     * @Method("GET")
     */
    public function showAction(Proceso $proceso)
    {
        $deleteForm = $this->createDeleteForm($proceso);

        return $this->render('proceso/show.html.twig', array(
            'proceso' => $proceso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing proceso entity.
     *
     * @Route("/{idProceso}/edit", name="proceso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Proceso $proceso)
    {
        $deleteForm = $this->createDeleteForm($proceso);
        $editForm = $this->createForm('GestionBundle\Form\ProcesoType', $proceso);
        $editForm->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $proceso->setUsuarioActualizacion($usuarioActualizacion);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proceso_edit', array('idProceso' => $proceso->getIdproceso()));
        }

        return $this->render('proceso/edit.html.twig', array(
            'proceso' => $proceso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a proceso entity.
     *
     * @Route("/{idProceso}", name="proceso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Proceso $proceso)
    {
        $form = $this->createDeleteForm($proceso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($proceso);
            $em->flush();
        }

        return $this->redirectToRoute('proceso_index');
    }

    /**
     * Creates a form to delete a proceso entity.
     *
     * @param Proceso $proceso The proceso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Proceso $proceso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proceso_delete', array('idProceso' => $proceso->getIdproceso())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
