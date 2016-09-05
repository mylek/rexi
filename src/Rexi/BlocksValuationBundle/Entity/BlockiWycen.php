<?php

namespace Rexi\BlocksValuationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bloki_wycen")
 */
class BlokiWycen {
    
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
    private $id_rodzica;
    
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
}

