<?php

namespace Rexi\BlocksValuationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Rexi\BlocksValuationBundle\Form\Type\UserInfoType;
use Rexi\BlocksValuationBundle\Form\Type\InwestycjeType;
use Symfony\Component\HttpFoundation\Request;
use Rexi\UserBundle\Entity\UserInfo;
use Rexi\BlocksValuationBundle\Entity\Inwestycje;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/wyceny")
 */
class WycenyController extends Controller
{    
    /**
     * @Route(
     *      "/",
     *      name = "rexi_wycen_routing",
     * )
     */
    public function routingAction()
    {
        $User = $this->getUser();
        $Repo = $this->getDoctrine()->getRepository('RexiBlocksValuationBundle:Inwestycje');
        $inwestycje = $Repo->getInwestycjaOtwarteUser($User->getId());
        
        if(!empty($inwestycje)){
            return $this->redirect($this->generateUrl('rexi_wyceny_bloki'));
        } else {
            return $this->redirect($this->generateUrl('rexi_wycen_uzupelnij'));
        }
        
    }
    
    /**
     * @Route(
     *      "/bloki/{id}",
     *      name = "rexi_wyceny_bloki",
     *      defaults = {"id" = ""}
     * )
     * @Template()
     */
    public function blokiAction($id)
    {
        $blokiManager = $this->get('bloki_manager');
        $bloki = $blokiManager->pobierzDzieci($id);
        return array(
            'bloki' => $bloki
        );
    }
    
    /**
     * @Route(
     *      "/uzupelnij",
     *      name = "rexi_wycen_uzupelnij",
     * )
     * @Template()
     */
    public function uzupelnijDaneAction(Request $Request)
    {
        $User = $this->getUser();
        $Repo = $this->getDoctrine()->getRepository('RexiUserBundle:UserInfo');
        $userInfo = $Repo->findBy(array('id_user' => $User->getId()))[0];
        
        $userInfoForm = $this->createForm(new UserInfoType(), $userInfo);
        $userInfoForm->handleRequest($Request);

        if($Request->isMethod('POST')){
            $Session = $this->get('session');
            if($userInfoForm->isValid()){
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($userInfo);
                $em->flush();
                
                $Session->getFlashBag()->add('success', 'Dane zostały zapisane');
                return $this->redirect($this->generateUrl('rexi_wycen_uzupelnij_inwestycje'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza!');
            }
        }
        
        
        return array(
            'form' => $userInfoForm->createView()
        );
    }
    
    /**
     * @Route(
     *      "/uzupelnij_inwestycje",
     *      name = "rexi_wycen_uzupelnij_inwestycje",
     * )
     * @Template()
     */
    public function uzupelnijInwestycjeAction(Request $Request) {
        
        // pobranie encji uzytkownika
        $User = $this->getUser();
        if(NULL == $User){
            throw $this->createNotFoundException('Nie znaleziono takiego użytkownika');
        }
        
        $inwestycje = new Inwestycje();
        $inwestycje->setIdUser($User);
        
        $inwestycjeForm = $this->createForm(new InwestycjeType(), $inwestycje);
        $inwestycjeForm->handleRequest($Request);
        $postData = $Request->request->all();
        
        $inwestorzy = array();
        $inwestorzyHtml = '';
        // pobiera inwestorów
        if(!empty($postData['inwestor']['imie'])) {
            foreach($postData['inwestor']['imie'] as $key => $val) {           
                $inwestorzy[$key]['imie'] = $postData['inwestor']['imie'][$key];
                $inwestorzy[$key]['imie_drugie'] = $postData['inwestor']['imie_drugie'][$key];
                $inwestorzy[$key]['nazwisko'] = $postData['inwestor']['nazwisko'][$key];
                $inwestorzy[$key]['imie_ojca'] = $postData['inwestor']['imie_ojca'][$key];
                $inwestorzy[$key]['imie_matki'] = $postData['inwestor']['imie_matki'][$key];
                $inwestorzy[$key]['data_urodzenia'] = $postData['inwestor']['data_urodzenia'][$key];
                if(isset($postData['inwestor']['plec'][$key]))
                    $inwestorzy[$key]['plec'] = $postData['inwestor']['plec'][$key];
                
                if(isset($postData['inwestor']['rodzaj'][$key]))
                    $inwestorzy[$key]['rodzaj'] = $postData['inwestor']['rodzaj'][$key];
                
                if(isset($postData['inwestor']['rodzaj_nazwa'][$key]))
                    $inwestorzy[$key]['rodzaj_nazwa'] = $postData['inwestor']['rodzaj_nazwa'][$key];
                
                $inwestorzy[$key]['kod_pocztowy'] = $postData['inwestor']['kod_pocztowy'][$key];
                $inwestorzy[$key]['miasto'] = $postData['inwestor']['miasto'][$key];
                $inwestorzy[$key]['miejscowosc'] = $postData['inwestor']['miejscowosc'][$key];
                $inwestorzy[$key]['ulica'] = $postData['inwestor']['ulica'][$key];
                $inwestorzy[$key]['nr_domu'] = $postData['inwestor']['nr_domu'][$key];
                $inwestorzy[$key]['nr_lokalu'] = $postData['inwestor']['nr_lokalu'][$key];
                $inwestorzy[$key]['miejsce_urodzenia'] = $postData['inwestor']['miejsce_urodzenia'][$key];
                $inwestorzy[$key]['data_wydania_dowodu'] = $postData['inwestor']['data_wydania_dowodu'][$key];
                $inwestorzy[$key]['data_waznosci_dowodu'] = $postData['inwestor']['data_waznosci_dowodu'][$key];
                $inwestorzy[$key]['organizacja_wydajaca_dowodu'] = $postData['inwestor']['organizacja_wydajaca_dowodu'][$key];
                $inwestorzy[$key]['pesel'] = $postData['inwestor']['pesel'][$key];
                $inwestorzy[$key]['nr_dowodu'] = $postData['inwestor']['nr_dowodu'][$key];
                $inwestorzy[$key]['kod_pocztowy_zamieszkania'] = $postData['inwestor']['kod_pocztowy_zamieszkania'][$key];
                $inwestorzy[$key]['miasto_zamieszkania'] = $postData['inwestor']['miasto_zamieszkania'][$key];
                $inwestorzy[$key]['miejscowosc_zamieszkania'] = $postData['inwestor']['miejscowosc_zamieszkania'][$key];
                $inwestorzy[$key]['ulica_zamieszkania'] = $postData['inwestor']['ulica_zamieszkania'][$key];
                $inwestorzy[$key]['nr_domu_zamieszkania'] = $postData['inwestor']['nr_domu_zamieszkania'][$key];
                $inwestorzy[$key]['nr_lokalu_zamieszkania'] = $postData['inwestor']['nr_lokalu_zamieszkania'][$key];
                $inwestorzy[$key]['kod_pocztowy_korespondencji'] = $postData['inwestor']['kod_pocztowy_korespondencji'][$key];
                $inwestorzy[$key]['miasto_korespondencji'] = $postData['inwestor']['miasto_korespondencji'][$key];
                $inwestorzy[$key]['miejscowosc_korespondencji'] = $postData['inwestor']['miejscowosc_korespondencji'][$key];
                $inwestorzy[$key]['ulica_korespondencji'] = $postData['inwestor']['ulica_korespondencji'][$key];
                $inwestorzy[$key]['nr_domu_korespondencji'] = $postData['inwestor']['nr_domu_korespondencji'][$key];
                $inwestorzy[$key]['nr_lokalu_korespondencji'] = $postData['inwestor']['nr_lokalu_korespondencji'][$key];
                $inwestorzyHtml .= $this->renderView('RexiBlocksValuationBundle:Wyceny:inwestor.html.twig', array('inwestor' => $inwestorzy[$key]));
            }
        }
        
        if($Request->isMethod('POST')){
            $Session = $this->get('session');
            if($inwestycjeForm->isValid()){
                
                if(!empty($inwestorzy)) {
                    $inwestycje->setInwestorzy(serialize($inwestorzy));
                }
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($inwestycje);
                $em->flush();
                
                $Session->getFlashBag()->add('success', 'Dane zostały zapisane');
                //return $this->redirect($this->generateUrl('rexi_wycen_uzupelnij_inwestycje'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza!');
            }
        }
        
        return array(
            'form' => $inwestycjeForm->createView(),
            'inwestorzyHtml' => $inwestorzyHtml
        );
    }
    
    /**
     * @Route(
     *      "/ajax_inwestor",
     *      name = "rexi_wycen_uzupelnij_ajax_inwestor",
     * )
     */
    public function ajaxFormInwestorAction() {
        return $this->render('RexiBlocksValuationBundle:Wyceny:inwestor.html.twig');
    }
}
