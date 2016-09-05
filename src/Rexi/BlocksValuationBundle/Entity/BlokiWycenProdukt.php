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
     * @ORM\Column(type="string", length = 128)
    */
    private $nazwa;
    
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
     * @ORM\ManyToOne(
     *      targetEntity = "BlokiWycen",
     *      inversedBy = "produkty"
     * )
     * 
     * @ORM\JoinColumn(
     *      name = "id_bloku",
     *      referencedColumnName = "id",
     *      onDelete = "SET NULL"
     * )
     */
    private $blok;
}
