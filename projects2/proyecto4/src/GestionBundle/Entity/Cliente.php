<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity
 */
class Cliente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cliente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre1", type="string", length=100, nullable=false)
     */
    private $nombre1;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre2", type="string", length=100, nullable=true)
     */
    private $nombre2;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido1", type="string", length=100, nullable=false)
     */
    private $apellido1;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido2", type="string", length=100, nullable=true)
     */
    private $apellido2;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_creacion", type="string", length=30, nullable=false)
     */
    private $usuarioCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=true)
     */
    private $fechaActualizacion = null;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_actualizacion", type="string", length=30, nullable=false)
     */
    private $usuarioActualizacion;

    /**
     * @return int
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * @param int $idCliente
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }

    /**
     * @return string
     */
    public function getNombre1()
    {
        return $this->nombre1;
    }

    /**
     * @param string $nombre1
     */
    public function setNombre1($nombre1)
    {
        $this->nombre1 = $nombre1;
    }

    /**
     * @return string
     */
    public function getNombre2()
    {
        return $this->nombre2;
    }

    /**
     * @param string $nombre2
     */
    public function setNombre2($nombre2)
    {
        $this->nombre2 = $nombre2;
    }

    /**
     * @return string
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * @param string $apellido1
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;
    }

    /**
     * @return string
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * @param string $apellido2
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;
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

    public function __toString()
    {
        return $this->nombre1;
    }
}

