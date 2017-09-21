<?php

namespace AdministracionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="id_rol", columns={"id_rol"})})
 * @ORM\Entity
 */
class Usuario implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=50, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="contrasenia", type="string", length=1000, nullable=false)
     */
    private $contrasenia;

    /**
     * @var string
     *
     * @ORM\Column(name="rol", type="string", length=200, nullable=true)
     */
    private $rol;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_creacion", type="string", length=30, nullable=false)
     */
    private $usuarioCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     */
    private $fechaCreacion = null;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_actualizacion", type="string", length=30, nullable=false)
     */
    private $usuarioActualizacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=true)
     */
    private $fechaActualizacion = null;

    /**
     * @var \Rol
     *
     * @ORM\ManyToOne(targetEntity="Rol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rol", referencedColumnName="id_rol")
     * })
     */
    private $idRol;

    private $plainPassword;

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($contrasenia)
    {
        $this->plainPassword = $contrasenia;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->usuario;
    }
    /**
     * Set username
     *
     * @param string $usuario
     *
     * @return Usuario
     */
    public function setUsername($usuario)
    {
        $this->usuario = $usuario;
    }
    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->contrasenia;
    }
    /**
     * Set password
     *
     * @param string $contrasenia
     *
     * @return Usuario
     */
    public function setPassword($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param int $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return string
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    /**
     * @param string $contrasenia
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    /**
     * @return string
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param string $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return string
     */
    public function getUsuarioCreacion()
    {
        return $this->usuarioCreacion;
    }

    /**
     * @param string $usuarioCreacion
     */
    public function setUsuarioCreacion($usuarioCreacion)
    {
        $this->usuarioCreacion = $usuarioCreacion;
    }

    /**
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param \DateTime $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * @return string
     */
    public function getUsuarioActualizacion()
    {
        return $this->usuarioActualizacion;
    }

    /**
     * @param string $usuarioActualizacion
     */
    public function setUsuarioActualizacion($usuarioActualizacion)
    {
        $this->usuarioActualizacion = $usuarioActualizacion;
    }

    /**
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * @param \DateTime $fechaActualizacion
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    }

    /**
     * @return \Rol
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * @param \Rol $idRol
     */
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;
    }

    /**
     * Set roles
     * @param string $roles
     *
     * @return Usuario
     */
    public function setRoles($rol)
    {
        $this->rol =$rol;

        //allows for chaining
        return $this;
    }

    public function getRoles()
    {
        //return $this->rol;
        return array($this->rol);
    }

    public function getSalt()
    {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function eraseCredentials() {}

    public function __toString()
    {
        return $this->usuario;
    }
}

