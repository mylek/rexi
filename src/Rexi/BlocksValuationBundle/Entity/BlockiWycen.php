<?php

namespace Rexi\BlocksValuationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bloki_wycen")
 */
class BlockiWycen {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;
    
    /**
     * @ORM\Column(type="string", length = 128)
     */
    private $nazwa;
    
    /**
     * @ORM\Column(type="string", length = 8)
     */
    private $kolor;
    
    /**
     * @ORM\Column(name="id_rodzica", type="integer")
     */
    private $id_rodzica = 0;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $typ;
    
    /**
     * @ORM\Column(name="data_dodania", type="datetime", nullable=true)
     */
    private $data_dodania;
    
    /**
     * @ORM\OneToMany(
     *      targetEntity = "BlokiWycenProdukt",
     *      mappedBy = "blok"
     * )
     */
    private $produkty;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produkty = new \Doctrine\Common\Collections\ArrayCollection();
        $this->data_dodania = new \DateTime();
    }

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
     * Set nazwa
     *
     * @param string $nazwa
     * @return BlockiWycen
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string 
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set kolor
     *
     * @param string $kolor
     * @return BlockiWycen
     */
    public function setKolor($kolor)
    {
        $this->kolor = $kolor;

        return $this;
    }

    /**
     * Get kolor
     *
     * @return string 
     */
    public function getKolor()
    {
        return $this->kolor;
    }

    /**
     * Set id_rodzica
     *
     * @param integer $idRodzica
     * @return BlockiWycen
     */
    public function setIdRodzica($idRodzica)
    {
        $this->id_rodzica = $idRodzica;

        return $this;
    }

    /**
     * Get id_rodzica
     *
     * @return integer 
     */
    public function getIdRodzica()
    {
        return $this->id_rodzica;
    }

    /**
     * Set typ
     *
     * @param integer $typ
     * @return BlockiWycen
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;

        return $this;
    }

    /**
     * Get typ
     *
     * @return integer 
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Set data_dodania
     *
     * @param \DateTime $dataDodania
     * @return BlockiWycen
     */
    public function setDataDodania($dataDodania)
    {
        $this->data_dodania = $dataDodania;

        return $this;
    }

    /**
     * Get data_dodania
     *
     * @return \DateTime 
     */
    public function getDataDodania()
    {
        return $this->data_dodania;
    }

    /**
     * Add produkty
     *
     * @param \Rexi\BlocksValuationBundle\Entity\BlokiWycenProdukt $produkty
     * @return BlockiWycen
     */
    public function addProdukty(\Rexi\BlocksValuationBundle\Entity\BlokiWycenProdukt $produkty)
    {
        $this->produkty[] = $produkty;

        return $this;
    }

    /**
     * Remove produkty
     *
     * @param \Rexi\BlocksValuationBundle\Entity\BlokiWycenProdukt $produkty
     */
    public function removeProdukty(\Rexi\BlocksValuationBundle\Entity\BlokiWycenProdukt $produkty)
    {
        $this->produkty->removeElement($produkty);
    }

    /**
     * Get produkty
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProdukty()
    {
        return $this->produkty;
    }
}
