<?php

namespace AdministracionBundle\Controller;

use AdministracionBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Usuario controller.
 *
 * @Route("usuario")
 */
class UsuarioController extends Controller
{
    /**
     * Lists all usuario entities.
     *
     * @Route("/", name="usuario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('AdministracionBundle:Usuario')->findAll();

        return $this->render('usuario/index.html.twig', array(
            'usuarios' => $usuarios,
        ));
    }

    /**
     * Creates a new usuario entity.
     *
     * @Route("/new", name="usuario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $usuario = new Usuario();
        $form = $this->createForm('AdministracionBundle\Form\UsuarioType', $usuario);
        $form->handleRequest($request);

        $contrasenia = $this->get('security.password_encoder')->encodePassword($usuario, $usuario->getPlainPassword());
        $usuario->setPassword($contrasenia);

        $usuarioCreacion = $this->getUser();
        $usuario->setUsuarioCreacion($usuarioCreacion);

        $usuarioActualizacion = $this->getUser();
        $usuario->setUsuarioActualizacion($usuarioActualizacion);

        if ($form->isSubmitted() && $form->isValid()) {
            $aux = 'ROLE_';
            $aux2 = $usuario->getIdRol();
            $usuario->setRol($aux.$aux2);

            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('usuario_show', array('idUsuario' => $usuario->getIdusuario()));
        }

        return $this->render('usuario/new.html.twig', array(
            'usuario' => $usuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a usuario entity.
     *
     * @Route("/{idUsuario}", name="usuario_show")
     * @Method("GET")
     */
    public function showAction(Usuario $usuario)
    {
        $deleteForm = $this->createDeleteForm($usuario);

        return $this->render('usuario/show.html.twig', array(
            'usuario' => $usuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usuario entity.
     *
     * @Route("/{idUsuario}/edit", name="usuario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Usuario $usuario)
    {
        $deleteForm = $this->createDeleteForm($usuario);
        $editForm = $this->createForm('AdministracionBundle\Form\UsuarioType', $usuario);
        $editForm->handleRequest($request);

        $usuarioActualizacion = $this->getUser();
        $usuario->setUsuarioActualizacion($usuarioActualizacion);

        $aux = 'ROLE_';
        $aux2 = $usuario->getIdRol();
        $usuario->setRol($aux.$aux2);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usuario_edit', array('idUsuario' => $usuario->getIdusuario()));
        }

        return $this->render('usuario/edit.html.twig', array(
            'usuario' => $usuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usuario entity.
     *
     * @Route("/{idUsuario}", name="usuario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Usuario $usuario)
    {
        $form = $this->createDeleteForm($usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuario);
            $em->flush();
        }

        return $this->redirectToRoute('usuario_index');
    }

    /**
     * Creates a form to delete a usuario entity.
     *
     * @param Usuario $usuario The usuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Usuario $usuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuario_delete', array('idUsuario' => $usuario->getIdusuario())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
