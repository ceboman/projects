<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table(name="area")
 * @ORM\Entity
 */
class Area
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_area", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArea;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

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
     * @return int
     */
    public function getIdArea()
    {
        return $this->idArea;
    }

    /**
     * @param int $idArea
     */
    public function setIdArea($idArea)
    {
        $this->idArea = $idArea;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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

    public function __toString()
    {
        return $this->nombre;
    }
}

