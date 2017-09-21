<?php

namespace AdministracionBundle\Controller;

use AdministracionBundle\Entity\UsuarioSucursal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Usuariosucursal controller.
 *
 * @Route("usuariosucursal")
 */
class UsuarioSucursalController extends Controller
{
    /**
     * Lists all usuarioSucursal entities.
     *
     * @Route("/", name="usuariosucursal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarioSucursals = $em->getRepository('AdministracionBundle:UsuarioSucursal')->findAll();

        return $this->render('usuariosucursal/index.html.twig', array(
            'usuarioSucursals' => $usuarioSucursals,
        ));
    }

    /**
     * Creates a new usuarioSucursal entity.
     *
     * @Route("/new", name="usuariosucursal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $usuarioSucursal = new Usuariosucursal();
        $form = $this->createForm('AdministracionBundle\Form\UsuarioSucursalType', $usuarioSucursal);
        $form->handleRequest($request);

        $usuarioCreacion = $this->getUser();
        $usuarioSucursal->setUsuarioCreacion($usuarioCreacion);

        $usuarioActualizacion = $this->getUser();
        $usuarioSucursal->setUsuarioActualizacion($usuarioActualizacion);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuarioSucursal);
            $em->flush();

            return $this->redirectToRoute('usuariosucursal_show', array('idUsuarioSucursal' => $usuarioSucursal->getIdusuariosucursal()));
        }

        return $this->render('usuariosucursal/new.html.twig', array(
            'usuarioSucursal' => $usuarioSucursal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a usuarioSucursal entity.
     *
     * @Route("/{idUsuarioSucursal}", name="usuariosucursal_show")
     * @Method("GET")
     */
    public function showAction(UsuarioSucursal $usuarioSucursal)
    {
        $deleteForm = $this->createDeleteForm($usuarioSucursal);

        return $this->render('usuariosucursal/show.html.twig', array(
            'usuarioSucursal' => $usuarioSucursal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usuarioSucursal entity.
     *
     * @Route("/{idUsuarioSucursal}/edit", name="usuariosucursal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UsuarioSucursal $usuarioSucursal)
    {
        $deleteForm = $this->createDeleteForm($usuarioSucursal);
        $editForm = $this->createForm('AdministracionBundle\Form\UsuarioSucursalType', $usuarioSucursal);
        $editForm->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $usuarioSucursal->setUsuarioActualizacion($usuarioActualizacion);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usuariosucursal_edit', array('idUsuarioSucursal' => $usuarioSucursal->getIdusuariosucursal()));
        }

        return $this->render('usuariosucursal/edit.html.twig', array(
            'usuarioSucursal' => $usuarioSucursal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usuarioSucursal entity.
     *
     * @Route("/{idUsuarioSucursal}", name="usuariosucursal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UsuarioSucursal $usuarioSucursal)
    {
        $form = $this->createDeleteForm($usuarioSucursal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuarioSucursal);
            $em->flush();
        }

        return $this->redirectToRoute('usuariosucursal_index');
    }

    /**
     * Creates a form to delete a usuarioSucursal entity.
     *
     * @param UsuarioSucursal $usuarioSucursal The usuarioSucursal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UsuarioSucursal $usuarioSucursal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuariosucursal_delete', array('idUsuarioSucursal' => $usuarioSucursal->getIdusuariosucursal())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
