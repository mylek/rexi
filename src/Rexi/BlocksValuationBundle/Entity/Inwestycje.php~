<?php

namespace Rexi\BlocksValuationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="inwestycje")
 */

class Inwestycje {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;
    
    /**
     * @ORM\Column(type="string", length = 6, nullable=true)
     */
    private $kod_pocztowy;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $miasto;
    /**
     * @ORM\Column(type="string", length = 64)
     */
    
    private $miejscowosc;
    /**
     * @ORM\Column(type="string", length = 128)
     */
    
    private $ulica;
    
    /**
     * @ORM\Column(type="string", length = 8)
     */
    private $nr_domu;
    
    /**
     * @ORM\Column(type="string", length = 8)
     */
    private $nr_lokalu;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $nr_dzialki;
    
    /**
     * @ORM\ManyToOne(targetEntity="Common\UserBundle\Entity\User", inversedBy="inwestycje")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $id_user;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $inwestorzy;
    
    /**
     * @ORM\Column(name="data_dodania", type="datetime")
     */
    private $data_dodania;
    
    public function __construct() {
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
     * Set miasto
     *
     * @param string $miasto
     * @return Inwestycje
     */
    public function setMiasto($miasto)
    {
        $this->miasto = $miasto;

        return $this;
    }

    /**
     * Get miasto
     *
     * @return string 
     */
    public function getMiasto()
    {
        return $this->miasto;
    }

    /**
     * Set miejscowosc
     *
     * @param string $miejscowosc
     * @return Inwestycje
     */
    public function setMiejscowosc($miejscowosc)
    {
        $this->miejscowosc = $miejscowosc;

        return $this;
    }

    /**
     * Get miejscowosc
     *
     * @return string 
     */
    public function getMiejscowosc()
    {
        return $this->miejscowosc;
    }

    /**
     * Set ulica
     *
     * @param string $ulica
     * @return Inwestycje
     */
    public function setUlica($ulica)
    {
        $this->ulica = $ulica;

        return $this;
    }

    /**
     * Get ulica
     *
     * @return string 
     */
    public function getUlica()
    {
        return $this->ulica;
    }

    /**
     * Set nr_domu
     *
     * @param string $nrDomu
     * @return Inwestycje
     */
    public function setNrDomu($nrDomu)
    {
        $this->nr_domu = $nrDomu;

        return $this;
    }

    /**
     * Get nr_domu
     *
     * @return string 
     */
    public function getNrDomu()
    {
        return $this->nr_domu;
    }

    /**
     * Set nr_lokalu
     *
     * @param string $nrLokalu
     * @return Inwestycje
     */
    public function setNrLokalu($nrLokalu)
    {
        $this->nr_lokalu = $nrLokalu;

        return $this;
    }

    /**
     * Get nr_lokalu
     *
     * @return string 
     */
    public function getNrLokalu()
    {
        return $this->nr_lokalu;
    }

    /**
     * Set nr_dzialki
     *
     * @param string $nrDzialki
     * @return Inwestycje
     */
    public function setNrDzialki($nrDzialki)
    {
        $this->nr_dzialki = $nrDzialki;

        return $this;
    }

    /**
     * Get nr_dzialki
     *
     * @return string 
     */
    public function getNrDzialki()
    {
        return $this->nr_dzialki;
    }

    /**
     * Set inwestorzy
     *
     * @param string $inwestorzy
     * @return Inwestycje
     */
    public function setInwestorzy($inwestorzy)
    {
        $this->inwestorzy = $inwestorzy;

        return $this;
    }

    /**
     * Get inwestorzy
     *
     * @return string 
     */
    public function getInwestorzy()
    {
        return $this->inwestorzy;
    }

    /**
     * Set data_dodania
     *
     * @param \DateTime $dataDodania
     * @return Inwestycje
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
     * Set id_user
     *
     * @param \Common\UserBundle\Entity\User $idUser
     * @return Inwestycje
     */
    public function setIdUser(\Common\UserBundle\Entity\User $idUser = null)
    {
        $this->id_user = $idUser;

        return $this;
    }

    /**
     * Get id_user
     *
     * @return \Common\UserBundle\Entity\User 
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Set kod_pocztowy
     *
     * @param string $kodPocztowy
     * @return Inwestycje
     */
    public function setKodPocztowy($kodPocztowy)
    {
        $this->kod_pocztowy = $kodPocztowy;

        return $this;
    }

    /**
     * Get kod_pocztowy
     *
     * @return string 
     */
    public function getKodPocztowy()
    {
        return $this->kod_pocztowy;
    }
}
