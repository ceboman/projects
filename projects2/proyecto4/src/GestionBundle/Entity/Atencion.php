<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Atencion
 *
 * @ORM\Table(name="atencion", indexes={@ORM\Index(name="id_proceso", columns={"id_proceso"}), @ORM\Index(name="id_cliente", columns={"id_cliente"}), @ORM\Index(name="id_estado_atencion", columns={"id_estado_atencion"})})
 * @ORM\Entity
 */
class Atencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_atencion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAtencion;

    /**
     * @var integer
     *
     * @ORM\Column(name="secuencial", type="integer", nullable=false)
     */
    private $secuencial;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_creacion", type="string", length=30, nullable=false)
     */
    private $usuarioCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_actualizacion", type="string", length=30, nullable=false)
     */
    private $usuarioActualizacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=false)
     */
    private $fechaActualizacion = 'CURRENT_TIMESTAMP';

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
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cliente", referencedColumnName="id_cliente")
     * })
     */
    private $idCliente;

    /**
     * @var \EstadoAtencion
     *
     * @ORM\ManyToOne(targetEntity="EstadoAtencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_atencion", referencedColumnName="id_estado_atencion")
     * })
     */
    private $idEstadoAtencion;

    /**
     * @return int
     */
    public function getIdAtencion()
    {
        return $this->idAtencion;
    }

    /**
     * @param int $idAtencion
     */
    public function setIdAtencion($idAtencion)
    {
        $this->idAtencion = $idAtencion;
    }

    /**
     * @return int
     */
    public function getSecuencial()
    {
        return $this->secuencial;
    }

    /**
     * @param int $secuencial
     */
    public function setSecuencial($secuencial)
    {
        $this->secuencial = $secuencial;
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

    /**
     * @return \Cliente
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * @param \Cliente $idCliente
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }

    /**
     * @return \EstadoAtencion
     */
    public function getIdEstadoAtencion()
    {
        return $this->idEstadoAtencion;
    }

    /**
     * @param \EstadoAtencion $idEstadoAtencion
     */
    public function setIdEstadoAtencion($idEstadoAtencion)
    {
        $this->idEstadoAtencion = $idEstadoAtencion;
    }

    public function __toString()
    {
        return (string) $this->getSecuencial();
        //return $this->secuencial;
    }
}

