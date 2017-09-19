<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtencionDetalle
 *
 * @ORM\Table(name="atencion_detalle", indexes={@ORM\Index(name="id_atencion", columns={"id_atencion"}), @ORM\Index(name="id_proceso", columns={"id_proceso"})})
 * @ORM\Entity
 */
class AtencionDetalle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_atencion_detalle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAtencionDetalle;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=5000, nullable=false)
     */
    private $descripcion;

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
     * @var \Atencion
     *
     * @ORM\ManyToOne(targetEntity="Atencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_atencion", referencedColumnName="id_atencion")
     * })
     */
    private $idAtencion;

    /**
     * @var \Proceso
     *
     * @ORM\ManyToOne(targetEntity="Proceso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proceso", referencedColumnName="id_proceso")
     * })
     */
    private $idProceso;

    /**
     * @return int
     */
    public function getIdAtencionDetalle()
    {
        return $this->idAtencionDetalle;
    }

    /**
     * @param int $idAtencionDetalle
     */
    public function setIdAtencionDetalle($idAtencionDetalle)
    {
        $this->idAtencionDetalle = $idAtencionDetalle;
    }

    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
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
     * @return \Atencion
     */
    public function getIdAtencion()
    {
        return $this->idAtencion;
    }

    /**
     * @param \Atencion $idAtencion
     */
    public function setIdAtencion($idAtencion)
    {
        $this->idAtencion = $idAtencion;
    }

    /**
     * @return \Proceso
     */
    public function getIdProceso()
    {
        return $this->idProceso;
    }

    /**
     * @param \Proceso $idProceso
     */
    public function setIdProceso($idProceso)
    {
        $this->idProceso = $idProceso;
    }


}

