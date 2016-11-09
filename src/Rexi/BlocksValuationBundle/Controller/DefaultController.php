<?php

namespace Rexi\BlocksValuationBundle\Controller;

use Rexi\DashBoardBundle\Controller\CoreController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Rexi\BlocksValuationBundle\Form\Type\BlockType;
use Rexi\BlocksValuationBundle\Entity\BlockiWycen;
use Rexi\BlocksValuationBundle\Entity\BlokiWycenProdukt;

/**
 * @Route("/panel/bloki")
 */
class DefaultController extends CoreController
{
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->breadcrumbs->addItem("Lista bloków", $this->get("router")->generate("rexi_bloki_wycen_list"));
    }
    
    /**
     * @Route(
     *      "/",
     *      name = "rexi_bloki_wycen_list",
     * )
     * @Template()
     */
    public function indexAction()
    {
        $blokiManager = $this->get('bloki_manager');
        $bloki_wycen = $blokiManager->pobierzDrzewoBlokow();
        
        return array(
            'bloki_wycen' => $bloki_wycen
        );
    }
    
    /**
     * @Route(
     * "/dodaj",
     * name = "rexi_bloki_wycen_add"
     * )
     * @Template()
     */
    public function dodajAction(Request $Request)
    {
        $this->breadcrumbs->addItem("Dodaj blok");
        $BlockiWycen = new BlockiWycen();
        $addBlockForm = $this->createForm(new BlockType());
        $addBlockForm->get('typ')->setData(0);
        $addBlockForm->get('kolor')->setData('#000000');
        
         if($Request->isMethod('POST')){
            $Session = $this->get('session');
            
            $addBlockForm->handleRequest($Request);
            
            if($addBlockForm->isValid()){
                $postData = $Request->request->all();
                
                try {
                    
                    $BlockiWycen->setNazwa($postData['addBlok']['nazwa']);
                    $BlockiWycen->setKolor($postData['addBlok']['kolor']);
                    $BlockiWycen->setTyp($postData['addBlok']['typ']);
                    
                    if(!empty($postData['addBlok']['id_rodzica'])) {
                        $BlockiWycen->setIdRodzica($postData['addBlok']['id_rodzica']);
                    }
                    
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($BlockiWycen);
                    $em->flush();
                    
                    if($postData['addBlok']['typ'] == 1 && !empty($postData['p_cena'])) {
                        foreach($postData['p_cena'] as $key => $nazwa) {
                            if(!empty($postData['p_cena_klienta'][$key]) && !empty($postData['p_cena'][$key])) {
                                $BlockiWycenProdukt = new BlokiWycenProdukt();
                                $BlockiWycenProdukt->setCena($postData['p_cena'][$key]);
                                $BlockiWycenProdukt->setCenaKlienta($postData['p_cena_klienta'][$key]);
                                $BlockiWycenProdukt->setRabat($postData['p_rabat'][$key]);
                                $BlockiWycenProdukt->setBlok($BlockiWycen);
                                $em->persist($BlockiWycenProdukt);
                                $em->flush();
                            }
                        }
                    }
                    
                    $Session->getFlashBag()->add('success', 'Blok został dodany');
                    return $this->redirect($this->generateUrl('rexi_bloki_wycen_list'));
                } catch (Exception $exc) {
                    $this->get('session')->getFlashBag()->add('danger', $exc->getMessage());
                }
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw błedy formularza!');
            }
        }
        
        return array(
            'form' => $addBlockForm->createView()
        );
    }
    
    /**
     * @Route(
     *      "/aktualizuj/{id}",
     *      name="rexi_bloki_wycen_aktualizuj"
     * )
     * @Template
     */
    public function aktualizujAction(Request $Request, $id){
        $this->breadcrumbs->addItem("Edytuj blok");
        $Repo = $this->getDoctrine()->getRepository('RexiBlocksValuationBundle:BlockiWycen');
        $blok = $Repo->find($id);
        $produkty = array();
        $em = $this->getDoctrine()->getManager();
        
        if(NULL == $blok){
            throw $this->createNotFoundException('Nie znaleziono bloku o podanym ID');
        }
        
        $addBlockForm = $this->createForm(new BlockType());
        $addBlockForm->get('nazwa')->setData($blok->getNazwa());
        $addBlockForm->get('kolor')->setData($blok->getKolor());
        $id_rodzica = !empty($blok->getIdRodzica()) ? $blok->getIdRodzica(): 0;
        if($id_rodzica != 0)
            $addBlockForm->get('id_rodzica')->setData($em->getReference("RexiBlocksValuationBundle:BlockiWycen", $id_rodzica));
        $addBlockForm->get('typ')->setData($blok->getTyp());
        
        if($blok->getTyp() == 1) {
            $produkty = $blok->getProdukty();
        }
        
        
        if($Request->isMethod('POST')){
            $Session = $this->get('session');
            
            $addBlockForm->handleRequest($Request);
            
            if($addBlockForm->isValid()){
                $postData = $Request->request->all();
                
                $blok->setNazwa($postData['addBlok']['nazwa']);
                $blok->setTyp($postData['addBlok']['typ']);
                $blok->setKolor($postData['addBlok']['kolor']);
                $blok->setIdRodzica($postData['addBlok']['id_rodzica']);
                
                
                // usuwa produkty
                $produkty = $blok->getProdukty();
                foreach($produkty as $produkt) {
                    $em->remove($produkt);
                }
                
                if($postData['addBlok']['typ'] == 1 && !empty($postData['p_cena'])) {
                    foreach($postData['p_cena'] as $key => $nazwa) {
                        if(!empty($postData['p_cena_klienta'][$key]) && !empty($postData['p_cena'][$key])) {
                            $BlockiWycenProdukt = new BlokiWycenProdukt();
                            $BlockiWycenProdukt->setCena($postData['p_cena'][$key]);
                            $BlockiWycenProdukt->setCenaKlienta($postData['p_cena_klienta'][$key]);
                            $BlockiWycenProdukt->setRabat($postData['p_rabat'][$key]);
                            $BlockiWycenProdukt->setBlok($blok);
                            $em->persist($BlockiWycenProdukt);
                            $em->flush();
                        }
                    }
                }
                
                $em->persist($blok);
                $em->flush(); 
                
                $Session->getFlashBag()->add('success', 'Blok został zaktualizowany');
                return $this->redirect($this->generateUrl('rexi_bloki_wycen_list'));
            }
        }
        
        return array(
            'form' => $addBlockForm->createView(),
            'produkt' => reset($produkty)
        );
    }
}
