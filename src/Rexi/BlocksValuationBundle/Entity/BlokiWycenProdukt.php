<?php

namespace Rexi\BlocksValuationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bloki_wycen_produkt")
 */
class BlokiWycenProdukt {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;
    
    /**
     * @ORM\Column(name="data_dodania", type="datetime", nullable=true)
     */
    private $data_dodania;
    
    /**
     * @ORM\Column(type="float", scale=2)
    */
    private $cena;
    
    /**
     * @ORM\Column(type="float", scale=2)
    */
    private $cena_klienta;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $rabat = 0;
    
    /**
     * @ORM\ManyToOne(
     *      targetEntity = "BlockiWycen",
     *      inversedBy = "produkty"
     * )
     * 
     * @ORM\JoinColumn(
     *      name = "id_bloku",
     *      referencedColumnName = "id",
     *      onDelete = "CASCADE",
     *      nullable=true
     * )
     */
    private $blok;
    
    public function __construct()
    {
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
     * @return BlokiWycenProdukt
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
     * Set data_dodania
     *
     * @param \DateTime $dataDodania
     * @return BlokiWycenProdukt
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
     * Set cena
     *
     * @param float $cena
     * @return BlokiWycenProdukt
     */
    public function setCena($cena)
    {
        $this->cena = $cena;

        return $this;
    }

    /**
     * Get cena
     *
     * @return float 
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * Set cena_klienta
     *
     * @param float $cenaKlienta
     * @return BlokiWycenProdukt
     */
    public function setCenaKlienta($cenaKlienta)
    {
        $this->cena_klienta = $cenaKlienta;

        return $this;
    }

    /**
     * Get cena_klienta
     *
     * @return float 
     */
    public function getCenaKlienta()
    {
        return $this->cena_klienta;
    }

    /**
     * Set blok
     *
     * @param \Rexi\BlocksValuationBundle\Entity\BlockiWycen $blok
     * @return BlokiWycenProdukt
     */
    public function setBlok(\Rexi\BlocksValuationBundle\Entity\BlockiWycen $blok = null)
    {
        $this->blok = $blok;

        return $this;
    }

    /**
     * Get blok
     *
     * @return \Rexi\BlocksValuationBundle\Entity\BlockiWycen 
     */
    public function getBlok()
    {
        return $this->blok;
    }

    /**
     * Set rabat
     *
     * @param integer $rabat
     * @return BlokiWycenProdukt
     */
    public function setRabat($rabat)
    {
        $this->rabat = $rabat;

        return $this;
    }

    /**
     * Get rabat
     *
     * @return integer 
     */
    public function getRabat()
    {
        return $this->rabat;
    }
}
