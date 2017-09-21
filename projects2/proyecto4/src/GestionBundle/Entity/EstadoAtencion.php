<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoAtencion
 *
 * @ORM\Table(name="estado_atencion")
 * @ORM\Entity
 */
class EstadoAtencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_estado_atencion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstadoAtencion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @return int
     */
    public function getIdEstadoAtencion()
    {
        return $this->idEstadoAtencion;
    }

    /**
     * @param int $idEstadoAtencion
     */
    public function setIdEstadoAtencion($idEstadoAtencion)
    {
        $this->idEstadoAtencion = $idEstadoAtencion;
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

    public function __toString()
    {
        return $this->nombre;
    }
}

