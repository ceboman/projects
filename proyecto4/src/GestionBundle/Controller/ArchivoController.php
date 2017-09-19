<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Archivo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Archivo controller.
 *
 * @Route("archivo")
 */
class ArchivoController extends Controller
{
    /**
     * Lists all archivo entities.
     *
     * @Route("/", name="archivo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $archivos = $em->getRepository('GestionBundle:Archivo')->findAll();

        return $this->render('archivo/index.html.twig', array(
            'archivos' => $archivos,
        ));
    }

    /**
     * Creates a new archivo entity.
     *
     * @Route("/new", name="archivo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $archivo = new Archivo();
        $form = $this->createForm('GestionBundle\Form\ArchivoType', $archivo);
        $form->handleRequest($request);

        $usuarioCreacion = $this->getUser();
        $archivo->setUsuarioCreacion($usuarioCreacion);

        $usuarioActualizacion = $this->getUser();
        $archivo->setUsuarioActualizacion($usuarioActualizacion);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $archivo->getNombre();
            $natencion = $archivo->getIdAtencion();
            $fileName = $natencion.'_'.md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('uploads'), $fileName);

            $archivo->setNombre($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($archivo);
            $em->flush();

            return $this->redirectToRoute('archivo_show', array('idArchivo' => $archivo->getIdarchivo()));
        }

        return $this->render('archivo/new.html.twig', array(
            'archivo' => $archivo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a archivo entity.
     *
     * @Route("/{idArchivo}", name="archivo_show")
     * @Method("GET")
     */
    public function showAction(Archivo $archivo)
    {
        $deleteForm = $this->createDeleteForm($archivo);

        return $this->render('archivo/show.html.twig', array(
            'archivo' => $archivo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing archivo entity.
     *
     * @Route("/{idArchivo}/edit", name="archivo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Archivo $archivo)
    {
        $deleteForm = $this->createDeleteForm($archivo);
        $editForm = $this->createForm('GestionBundle\Form\ArchivoType', $archivo);
        $editForm->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $archivo->setUsuarioActualizacion($usuarioActualizacion);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('archivo_edit', array('idArchivo' => $archivo->getIdarchivo()));
        }

        return $this->render('archivo/edit.html.twig', array(
            'archivo' => $archivo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a archivo entity.
     *
     * @Route("/{idArchivo}", name="archivo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Archivo $archivo)
    {
        $form = $this->createDeleteForm($archivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($archivo);
            $em->flush();
        }

        return $this->redirectToRoute('archivo_index');
    }

    /**
     * Creates a form to delete a archivo entity.
     *
     * @param Archivo $archivo The archivo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Archivo $archivo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('archivo_delete', array('idArchivo' => $archivo->getIdarchivo())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
