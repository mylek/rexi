<?php

namespace Rexi\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Rexi\UserBundle\Form\Type\RegisterUserType;
use Common\UserBundle\Entity\User;
use Rexi\UserBundle\Entity\UserInfo;

/**
 * @Route("/panel/user")
 */
class DefaultController extends Controller
{
    protected $limit = 10;
    
    /**
     * @Route(
     * "/{page}",
     * name = "rexi_user_list",
     * defaults = {"page" = 1},
     * requirements = {"page" = "\d+"}
     * )
     * @Template()
     */
    public function indexAction($page)
    {
        $Repo = $this->getDoctrine()->getRepository('CommonUserBundle:User');
        $qb = $Repo->getQueryBuilder(array(
            'orderBy' => 'u.username'
        ));
        
        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate($qb, $page, $this->limit);
        
        return array(
            "users" => $users
        );
    }
    
    /**
     * @Route(
     *      "/aktualizuj/{id}",
     *      name="rexi_user_aktualizuj"
     * )
     * @Template
     */
    public function aktualizujAction(Request $Request, $id){
        $Repo = $this->getDoctrine()->getRepository('CommonUserBundle:User');
        $user = $Repo->find($id);
        //var_dump($user->getInfo());die;
        if(NULL == $user){
            throw $this->createNotFoundException('Nie znaleziono takiego uzytkownika');
        }
        
        $registerUserForm = $this->createForm(new RegisterUserType()/*, $User*/);
        $registerUserForm->get('email')->setData($user->getEmail());
        $registerUserForm->get('username')->setData($user->getUsername());
        $registerUserForm->get('typ')->setData($user->getTyp());
        $registerUserForm->get("imie")->setData($user->getInfo()->getImie());
        $registerUserForm->get("nazwisko")->setData($user->getInfo()->getNazwisko());
        $registerUserForm->get("imie_drugie")->setData($user->getInfo()->getImieDrugie());
        
        return array(
            'form' => $registerUserForm->createView()
        );
    }
    
    /**
     * @Route(
     * "/dodaj",
     * name = "rexi_add_user"
     * )
     * @Template()
     */
    public function dodajAction(Request $Request)
    {
        $User = new User();
        $UserInfo = new UserInfo();
        $registerUserForm = $this->createForm(new RegisterUserType()/*, $User*/);
        
        if($Request->isMethod('POST')){
            $Session = $this->get('session');
            
            $registerUserForm->handleRequest($Request);
            
            if($registerUserForm->isValid()){
                $postData = $Request->request->all()['userRegister'];
                try {
                    $encoderFactory = $this->container->get('security.encoder_factory');
                    $encoder = $encoderFactory->getEncoder($User);
                    $encodedPasswd = $encoder->encodePassword($User->getPlainPassword(), $User->getSalt());
                    $User->setPassword($encodedPasswd);
                    $User->setEnabled(true);
                    $User->setTyp($postData['typ']);
                    
                    if($User->getTyp() == 1) {
                        $User->setRoles(array('ROLE_USER'));
                    } else {
                        $User->setRoles(array('ROLE_ADMIN'));
                    }
                    
                    
                    $User->setEmail($postData['email']);
                    $User->setUsername($postData['username']);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($User);
                    $em->flush();
                    
                    $UserInfo->setIdUser($User);
                    $UserInfo->setImie($postData['imie']);
                    $UserInfo->setNazwisko($postData['nazwisko']);
                    $UserInfo->setPesel($postData['pesel']);
                    
                    $UserInfo->setImieDrugie($postData['imie_drugie']);
                    $UserInfo->setNrDowodu($postData['nr_dowodu']);
                    $UserInfo->setMiasto($postData['miasto']);
                    $UserInfo->setUlica($postData['ulica']);
                    $UserInfo->setNrDomu($postData['nr_domu']);
                    $UserInfo->setNrLokalu($postData['nr_lokalu']);
                    
                    $em->persist($UserInfo);
                    $em->flush();
                    
                    $User->setInfo($UserInfo);
                    $em->persist($User);
                    $em->flush();
                    
                    $Session->getFlashBag()->add('success', 'Uzytkownik został zapisany');
                } catch (Exception $exc) {
                    $this->get('session')->getFlashBag()->add('danger', $exc->getMessage());
                }
            }
            else {
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza!');
            }
        }
        
        return array(
            'form' => $registerUserForm->createView()
        );
    }
    
    /**
     * @Route(
     *      "/delete/{id}", 
     *      name="rexi_delete_user",
     *      requirements={"id"="\d+"}
     * )
     * 
     * @Template()
     */
    public function deleteAction($id) {
        $User = $this->getDoctrine()->getRepository('CommonUserBundle:User')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($User);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Poprawnie usunięto post wraz ze wszystkimi komentarzami');
        return $this->redirect($this->generateUrl('rexi_user_list'));
    }
}
