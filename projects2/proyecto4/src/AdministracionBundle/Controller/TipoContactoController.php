<?php

namespace AdministracionBundle\Controller;

use AdministracionBundle\Entity\TipoContacto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tipocontacto controller.
 *
 * @Route("tipocontacto")
 */
class TipoContactoController extends Controller
{
    /**
     * Lists all tipoContacto entities.
     *
     * @Route("/", name="tipocontacto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoContactos = $em->getRepository('AdministracionBundle:TipoContacto')->findAll();

        return $this->render('tipocontacto/index.html.twig', array(
            'tipoContactos' => $tipoContactos,
        ));
    }

    /**
     * Creates a new tipoContacto entity.
     *
     * @Route("/new", name="tipocontacto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoContacto = new Tipocontacto();
        $form = $this->createForm('AdministracionBundle\Form\TipoContactoType', $tipoContacto);
        $form->handleRequest($request);

        $usuarioCreacion = $this->getUser();
        $tipoContacto->setUsuarioCreacion($usuarioCreacion);

        $usuarioActualizacion = $this->getUser();
        $tipoContacto->setUsuarioActualizacion($usuarioActualizacion);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoContacto);
            $em->flush();

            return $this->redirectToRoute('tipocontacto_show', array('idTipoContacto' => $tipoContacto->getIdtipocontacto()));
        }

        return $this->render('tipocontacto/new.html.twig', array(
            'tipoContacto' => $tipoContacto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tipoContacto entity.
     *
     * @Route("/{idTipoContacto}", name="tipocontacto_show")
     * @Method("GET")
     */
    public function showAction(TipoContacto $tipoContacto)
    {
        $deleteForm = $this->createDeleteForm($tipoContacto);

        return $this->render('tipocontacto/show.html.twig', array(
            'tipoContacto' => $tipoContacto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tipoContacto entity.
     *
     * @Route("/{idTipoContacto}/edit", name="tipocontacto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoContacto $tipoContacto)
    {
        $deleteForm = $this->createDeleteForm($tipoContacto);
        $editForm = $this->createForm('AdministracionBundle\Form\TipoContactoType', $tipoContacto);
        $editForm->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $tipoContacto->setUsuarioActualizacion($usuarioActualizacion);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipocontacto_edit', array('idTipoContacto' => $tipoContacto->getIdtipocontacto()));
        }

        return $this->render('tipocontacto/edit.html.twig', array(
            'tipoContacto' => $tipoContacto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tipoContacto entity.
     *
     * @Route("/{idTipoContacto}", name="tipocontacto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoContacto $tipoContacto)
    {
        $form = $this->createDeleteForm($tipoContacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoContacto);
            $em->flush();
        }

        return $this->redirectToRoute('tipocontacto_index');
    }

    /**
     * Creates a form to delete a tipoContacto entity.
     *
     * @param TipoContacto $tipoContacto The tipoContacto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoContacto $tipoContacto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipocontacto_delete', array('idTipoContacto' => $tipoContacto->getIdtipocontacto())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
