<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoContacto
 *
 * @ORM\Table(name="tipo_contacto")
 * @ORM\Entity
 */
class TipoContacto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tipo_contacto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=30, nullable=false)
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
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=false)
     */
    private $fechaActualizacion = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_actualizacion", type="string", length=30, nullable=false)
     */
    private $usuarioActualizacion;

    /**
     * @return int
     */
    public function getIdTipoContacto()
    {
        return $this->idTipoContacto;
    }

    /**
     * @param int $idTipoContacto
     */
    public function setIdTipoContacto($idTipoContacto)
    {
        $this->idTipoContacto = $idTipoContacto;
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



}

