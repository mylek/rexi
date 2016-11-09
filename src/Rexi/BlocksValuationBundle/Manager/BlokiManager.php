<?php

namespace Rexi\BlocksValuationBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

class BlokiManager {
    
    /**
     * @var Doctrine
     */
    protected $doctrine;
    
    
    function __construct(Doctrine $doctrine) {
        $this->doctrine = $doctrine;
    }
    
    public function pobierzDrzewoBlokow() {
        $bloki_wycen = array();
        $Repo = $this->doctrine->getRepository('RexiBlocksValuationBundle:BlockiWycen');
        $wyceny = $Repo->findBy(array('id_rodzica' => ''));
        
        if(!empty($wyceny)) {
            foreach($wyceny as $wycena) {
                $bloki_wycen[] = $this->pobierzDrzewo($wycena, true);
            }
        }
        
        return $bloki_wycen;
    }
    
    public function pobierzDrzewo(\Rexi\BlocksValuationBundle\Entity\BlockiWycen $root, $pierwszy = FALSE) {
        $Repo = $this->doctrine->getRepository('RexiBlocksValuationBundle:BlockiWycen');
        $wyceny = $Repo->findBy(array('id_rodzica' => $root->getId()));
        
        $drzewo = array(
            'id' => $root->getId(),
            'nazwa' => $root->getNazwa(),
            'kolor' => $root->getKolor(),
            'typ' => $root->getTyp(),
        );
        
        if($pierwszy) {
            $drzewo['root'] = TRUE;
        } else {
            $drzewo['root'] = FALSE;
        }
        
        if(!empty($wyceny)) {
            $drzewo['dzieci'] = array();
            foreach($wyceny as $wycena) {
                $drzewo['dzieci'][] = $this->pobierzDrzewo($wycena);
            }
        }
        return $drzewo;
        
    }
    
    public function pobierzDzieci($id_root = '') {
        $Repo = $this->doctrine->getRepository('RexiBlocksValuationBundle:BlockiWycen');
        $bloki = $Repo->findBy(array('id_rodzica' => $id_root));
        return $bloki;
    }
}