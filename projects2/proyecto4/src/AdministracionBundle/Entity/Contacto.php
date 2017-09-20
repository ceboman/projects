<?php

namespace AdministracionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contacto
 *
 * @ORM\Table(name="contacto", indexes={@ORM\Index(name="id_tipo_contacto", columns={"id_tipo_contacto"})})
 * @ORM\Entity
 */
class Contacto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_contacto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContacto;

    /**
     * @var integer
     *
     * @ORM\Column(name="longitud_validacion", type="integer", nullable=false)
     */
    private $longitudValidacion;

    /**
     * @var string
     *
     * @ORM\Column(name="digitos_validacion", type="string", length=10, nullable=true)
     */
    private $digitosValidacion;

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
     * @var \TipoContacto
     *
     * @ORM\ManyToOne(targetEntity="TipoContacto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_contacto", referencedColumnName="id_tipo_contacto")
     * })
     */
    private $idTipoContacto;

    /**
     * @return int
     */
    public function getIdContacto()
    {
        return $this->idContacto;
    }

    /**
     * @param int $idContacto
     */
    public function setIdContacto($idContacto)
    {
        $this->idContacto = $idContacto;
    }

    /**
     * @return int
     */
    public function getLongitudValidacion()
    {
        return $this->longitudValidacion;
    }

    /**
     * @param int $longitudValidacion
     */
    public function setLongitudValidacion($longitudValidacion)
    {
        $this->longitudValidacion = $longitudValidacion;
    }

    /**
     * @return string
     */
    public function getDigitosValidacion()
    {
        return $this->digitosValidacion;
    }

    /**
     * @param string $digitosValidacion
     */
    public function setDigitosValidacion($digitosValidacion)
    {
        $this->digitosValidacion = $digitosValidacion;
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
     * @return \TipoContacto
     */
    public function getIdTipoContacto()
    {
        return $this->idTipoContacto;
    }

    /**
     * @param \TipoContacto $idTipoContacto
     */
    public function setIdTipoContacto($idTipoContacto)
    {
        $this->idTipoContacto = $idTipoContacto;
    }

    public function __toString()
    {
        return $this->digitosValidacion;
    }
}

