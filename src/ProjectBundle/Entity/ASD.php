<?php

namespace ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ASD
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ASD
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
     * @ORM\Column(name="name", type="string", length=500)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="prodaction", type="string", length=500)
     */
    private $prodaction;

    /**
     * @var string
     *
     * @ORM\Column(name="forma", type="string", length=500)
     */
    private $forma;

	/**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=500)
     */
    private $img;
	
    /**
     * @var string
     *
     * @ORM\Column(name="chokol", type="string", length=500)
     */
    private $chokol;

    /**
     * @var integer
     *
     * @ORM\Column(name="power", type="integer")
     */
    private $power;

    /**
     * @var string
     *
     * @ORM\Column(name="poverhnost", type="string", length=500)
     */
	 
	 
    private $poverhnost;
	
  /**
     * @var string
     *
     * @ORM\Column(name="shortDesc", type="string", length=500)
     */
	 
	 
    private $shortDesc;

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
     * Set shortDesc
     *
     * @param string $shortDesc
     *
     * @return ASD
     */
    public function setShortDesc($shortDesc)
    {
        $this->shortDesc = $shortDesc;

        return $this;
    }

    /**
     * Get shortDesc
     *
     * @return string
     */
    public function getShortDesc()
    {
        return $this->shortDesc;
    }
	
	
	
	
    /**
     * Set name
     *
     * @param string $name
     *
     * @return ASD
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

	
	/**
     * Set img
     *
     * @param string $img
     *
     * @return ASD
     */
    public function setImg($img)
    {
        $this->img= $img;

        return $this;
    }

	/**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }
	
    /**
     * Set prodaction
     *
     * @param string $prodaction
     *
     * @return ASD
     */
    public function setProdaction($prodaction)
    {
        $this->prodaction = $prodaction;

        return $this;
    }
	
    /**
     * Get prodaction
     *
     * @return string
     */
    public function getProdaction()
    {
        return $this->prodaction;
    }

    /**
     * Set forma
     *
     * @param string $forma
     *
     * @return ASD
     */
    public function setForma($forma)
    {
        $this->forma = $forma;

        return $this;
    }

    /**
     * Get forma
     *
     * @return string
     */
    public function getForma()
    {
        return $this->forma;
    }

    /**
     * Set chokol
     *
     * @param string $chokol
     *
     * @return ASD
     */
    public function setChokol($chokol)
    {
        $this->chokol = $chokol;

        return $this;
    }

    /**
     * Get chokol
     *
     * @return string
     */
    public function getChokol()
    {
        return $this->chokol;
    }

    /**
     * Set power
     *
     * @param integer $power
     *
     * @return ASD
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return integer
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set poverhnost
     *
     * @param string $poverhnost
     *
     * @return ASD
     */
    public function setPoverhnost($poverhnost)
    {
        $this->poverhnost = $poverhnost;

        return $this;
    }

    /**
     * Get poverhnost
     *
     * @return string
     */
    public function getPoverhnost()
    {
        return $this->poverhnost;
    }
}

