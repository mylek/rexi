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
}
