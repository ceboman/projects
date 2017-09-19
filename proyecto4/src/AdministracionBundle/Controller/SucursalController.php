<?php

namespace AdministracionBundle\Controller;

use AdministracionBundle\Entity\Sucursal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sucursal controller.
 *
 * @Route("sucursal")
 */
class SucursalController extends Controller
{
    /**
     * Lists all sucursal entities.
     *
     * @Route("/", name="sucursal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sucursals = $em->getRepository('AdministracionBundle:Sucursal')->findAll();

        return $this->render('sucursal/index.html.twig', array(
            'sucursals' => $sucursals,
        ));
    }

    /**
     * Creates a new sucursal entity.
     *
     * @Route("/new", name="sucursal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sucursal = new Sucursal();
        $form = $this->createForm('AdministracionBundle\Form\SucursalType', $sucursal);
        $form->handleRequest($request);

        $usuarioCreacion = $this->getUser();
        $sucursal->setUsuarioCreacion($usuarioCreacion);

        $usuarioActualizacion = $this->getUser();
        $sucursal->setUsuarioActualizacion($usuarioActualizacion);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sucursal);
            $em->flush();

            return $this->redirectToRoute('sucursal_show', array('idSucursal' => $sucursal->getIdsucursal()));
        }

        return $this->render('sucursal/new.html.twig', array(
            'sucursal' => $sucursal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sucursal entity.
     *
     * @Route("/{idSucursal}", name="sucursal_show")
     * @Method("GET")
     */
    public function showAction(Sucursal $sucursal)
    {
        $deleteForm = $this->createDeleteForm($sucursal);

        return $this->render('sucursal/show.html.twig', array(
            'sucursal' => $sucursal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sucursal entity.
     *
     * @Route("/{idSucursal}/edit", name="sucursal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sucursal $sucursal)
    {
        $deleteForm = $this->createDeleteForm($sucursal);
        $editForm = $this->createForm('AdministracionBundle\Form\SucursalType', $sucursal);
        $editForm->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $sucursal->setUsuarioActualizacion($usuarioActualizacion);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sucursal_edit', array('idSucursal' => $sucursal->getIdsucursal()));
        }

        return $this->render('sucursal/edit.html.twig', array(
            'sucursal' => $sucursal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sucursal entity.
     *
     * @Route("/{idSucursal}", name="sucursal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sucursal $sucursal)
    {
        $form = $this->createDeleteForm($sucursal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sucursal);
            $em->flush();
        }

        return $this->redirectToRoute('sucursal_index');
    }

    /**
     * Creates a form to delete a sucursal entity.
     *
     * @param Sucursal $sucursal The sucursal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sucursal $sucursal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sucursal_delete', array('idSucursal' => $sucursal->getIdsucursal())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
