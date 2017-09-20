<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Area;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Area controller.
 *
 * @Route("area")
 */
class AreaController extends Controller
{
    /**
     * Lists all area entities.
     *
     * @Route("/", name="area_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $areas = $em->getRepository('GestionBundle:Area')->findAll();

        return $this->render('area/index.html.twig', array(
            'areas' => $areas,
        ));
    }

    /**
     * Creates a new area entity.
     *
     * @Route("/new", name="area_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $area = new Area();
        $form = $this->createForm('GestionBundle\Form\AreaType', $area);
        $form->handleRequest($request);

        $usuarioCreacion = $this->getUser();
        $area->setUsuarioCreacion($usuarioCreacion);

        $usuarioActualizacion = $this->getUser();
        $area->setUsuarioActualizacion($usuarioActualizacion);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('area_show', array('idArea' => $area->getIdarea()));
        }

        return $this->render('area/new.html.twig', array(
            'area' => $area,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a area entity.
     *
     * @Route("/{idArea}", name="area_show")
     * @Method("GET")
     */
    public function showAction(Area $area)
    {
        $deleteForm = $this->createDeleteForm($area);

        return $this->render('area/show.html.twig', array(
            'area' => $area,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing area entity.
     *
     * @Route("/{idArea}/edit", name="area_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Area $area)
    {
        $deleteForm = $this->createDeleteForm($area);
        $editForm = $this->createForm('GestionBundle\Form\AreaType', $area);
        $editForm->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $area->setUsuarioActualizacion($usuarioActualizacion);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('area_edit', array('idArea' => $area->getIdarea()));
        }

        return $this->render('area/edit.html.twig', array(
            'area' => $area,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a area entity.
     *
     * @Route("/{idArea}", name="area_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Area $area)
    {
        $form = $this->createDeleteForm($area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($area);
            $em->flush();
        }

        return $this->redirectToRoute('area_index');
    }

    /**
     * Creates a form to delete a area entity.
     *
     * @param Area $area The area entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Area $area)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('area_delete', array('idArea' => $area->getIdarea())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
