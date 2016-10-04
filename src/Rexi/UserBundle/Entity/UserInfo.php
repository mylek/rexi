<?php

namespace Rexi\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Common\UserBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_info")
 */
class UserInfo {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Common\UserBundle\Entity\User", inversedBy="info")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $id_user;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $imie;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $nazwisko;
    
    /**
     * @ORM\Column(type="string", length = 16)
     */
    private $pesel;
    
    /**
     * @ORM\Column(type="string", length = 16)
     */
    private $nr_dowodu;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $imie_drugie;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $miasto;
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
     * @ORM\Column(type="string", length = 16)
     */
    private $telefon;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $stanowisko;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $funkcja;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $wyksztalcenie = null;

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
     * Set imie
     *
     * @param string $imie
     * @return UserInfo
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string 
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set nazwisko
     *
     * @param string $nazwisko
     * @return UserInfo
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get nazwisko
     *
     * @return string 
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * Set id_user
     *
     * @param \Common\UserBundle\Entity\User $idUser
     * @return UserInfo
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
     * Set pesel
     *
     * @param string $pesel
     * @return UserInfo
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * Get pesel
     *
     * @return string 
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * Set nr_dowodu
     *
     * @param string $nrDowodu
     * @return UserInfo
     */
    public function setNrDowodu($nrDowodu)
    {
        $this->nr_dowodu = $nrDowodu;

        return $this;
    }

    /**
     * Get nr_dowodu
     *
     * @return string 
     */
    public function getNrDowodu()
    {
        return $this->nr_dowodu;
    }

    /**
     * Set imie_drugie
     *
     * @param string $imieDrugie
     * @return UserInfo
     */
    public function setImieDrugie($imieDrugie)
    {
        $this->imie_drugie = $imieDrugie;

        return $this;
    }

    /**
     * Get imie_drugie
     *
     * @return string 
     */
    public function getImieDrugie()
    {
        return $this->imie_drugie;
    }

    /**
     * Set miasto
     *
     * @param string $miasto
     * @return UserInfo
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
     * Set ulica
     *
     * @param string $ulica
     * @return UserInfo
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
     * @param integer $nrDomu
     * @return UserInfo
     */
    public function setNrDomu($nrDomu)
    {
        $this->nr_domu = $nrDomu;

        return $this;
    }

    /**
     * Get nr_domu
     *
     * @return integer 
     */
    public function getNrDomu()
    {
        return $this->nr_domu;
    }

    /**
     * Set nr_lokalu
     *
     * @param integer $nrLokalu
     * @return UserInfo
     */
    public function setNrLokalu($nrLokalu)
    {
        $this->nr_lokalu = $nrLokalu;

        return $this;
    }

    /**
     * Get nr_lokalu
     *
     * @return integer 
     */
    public function getNrLokalu()
    {
        return $this->nr_lokalu;
    }

    /**
     * Set telefon
     *
     * @param string $telefon
     * @return UserInfo
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;

        return $this;
    }

    /**
     * Get telefon
     *
     * @return string 
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * Set stanowisko
     *
     * @param string $stanowisko
     * @return UserInfo
     */
    public function setStanowisko($stanowisko)
    {
        $this->stanowisko = $stanowisko;

        return $this;
    }

    /**
     * Get stanowisko
     *
     * @return string 
     */
    public function getStanowisko()
    {
        return $this->stanowisko;
    }

    /**
     * Set funkcja
     *
     * @param string $funkcja
     * @return UserInfo
     */
    public function setFunkcja($funkcja)
    {
        $this->funkcja = $funkcja;

        return $this;
    }

    /**
     * Get funkcja
     *
     * @return string 
     */
    public function getFunkcja()
    {
        return $this->funkcja;
    }

    /**
     * Set wyksztalcenie
     *
     * @param integer $wyksztalcenie
     * @return UserInfo
     */
    public function setWyksztalcenie($wyksztalcenie)
    {
        $this->wyksztalcenie = $wyksztalcenie;

        return $this;
    }

    /**
     * Get wyksztalcenie
     *
     * @return integer 
     */
    public function getWyksztalcenie()
    {
        return $this->wyksztalcenie;
    }
}
