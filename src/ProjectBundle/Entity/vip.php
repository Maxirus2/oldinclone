<?php

namespace ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * vip
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class vip
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tables", type="string", length=200)
     */
    private $tables;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tov", type="integer")
     */
    private $idTov;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tables
     *
     * @param string $tables
     *
     * @return vip
     */
    public function setTables($tables)
    {
        $this->tables = $tables;

        return $this;
    }

    /**
     * Get tables
     *
     * @return string
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * Set idTov
     *
     * @param integer $idTov
     *
     * @return vip
     */
    public function setIdTov($idTov)
    {
        $this->idTov = $idTov;

        return $this;
    }

    /**
     * Get idTov
     *
     * @return integer
     */
    public function getIdTov()
    {
        return $this->idTov;
    }
}

