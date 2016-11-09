<?php

namespace Rexi\BlocksValuationBundle\Controller;

use Rexi\DashBoardBundle\Controller\CoreController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/panel/wyceny")
 */
class ProjektyController extends CoreController
{
    protected $limit = 10;
    
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->breadcrumbs->addItem("Wyceny", $this->get("router")->generate("rexi_wyceny_projekty"));
    }
    
    /**
     * @Route(
     * "/{page}",
     * name = "rexi_wyceny_projekty",
     * defaults = {"page" = 1},
     * requirements = {"page" = "\d+"}
     * )
     * @Template()
     */
    public function indexAction($page)
    {
        $Repo = $this->getDoctrine()->getRepository('RexiBlocksValuationBundle:Inwestycje');
        
        $queryParams = array();
        $qb = $Repo->getQueryBuilder($queryParams);
        
        $paginator = $this->get('knp_paginator');
        $projekty = $paginator->paginate($qb, $page, $this->limit);
        
        return array(
            "projekty" => $projekty,
            "queryParams" => $queryParams,
        );
    }
    
    /**
     * @Route(
     *      "/delete/{id}", 
     *      name="rexi_delete_wycena",
     *      requirements={"id"="\d+"}
     * )
     * 
     * @Template()
     */
    public function deleteAction($id) {
        $Wycena = $this->getDoctrine()->getRepository('RexiBlocksValuationBundle:Inwestycje')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Wycena);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Poprawnie usunięto wycene');
        return $this->redirect($this->generateUrl('rexi_wyceny_projekty'));
    }
    
    /**
     * @Route(
     *      "/szczegoly/{id}",
     *      name="rexi_wyceny_szczegoly"
     * )
     * @Template
     */
    public function szczegolyAction($id){
        $this->breadcrumbs->addItem("Szczególy wyceny");
        $Wycena = $this->getDoctrine()->getRepository('RexiBlocksValuationBundle:Inwestycje');
        $wycena = $Wycena->find($id);
        if(NULL == $wycena){
            throw $this->createNotFoundException('Nie znaleziono takiej wyceny');
        }
        
        return array(
            "wycena" => $wycena,
            "user_info" => $wycena->getIdUser()->getInfo(),
            "inwestorzy" => $wycena->getInwestorzy(),
        );
    }
}
