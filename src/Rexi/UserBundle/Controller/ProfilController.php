<?php
namespace Rexi\UserBundle\Controller;

use Rexi\DashBoardBundle\Controller\CoreController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Rexi\UserBundle\Form\Type\AccountSettingsType;
use Rexi\UserBundle\Form\Type\ChangePasswordType;

/**
 * @Route("/panel/profil")
 */
class ProfilController extends CoreController {
    
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->breadcrumbs->addItem("Profil", $this->get("router")->generate("rexi_user_profil"));
    }
    
    /**
     * @Route(
     * "/",
     * name = "rexi_user_profil"
     * )
     * @Template()
     */
    public function indexAction(Request $Request)
    {
        $User = $this->getUser();
        
        // Account Settings Form
        $accountSettingsForm = $this->createForm(new AccountSettingsType(), $User);
        if($Request->isMethod('POST') && $Request->request->has('accountSettings')){
            $accountSettingsForm->handleRequest($Request);
            if($accountSettingsForm->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($User);
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('success', 'Twoje dane zostały zmienione!');
                return $this->redirect($this->generateUrl('rexi_user_profil'));
            }else{
                $this->get('session')->getFlashBag()->add('error', 'Popraw błędy formularza!');
            }
        }
        
        // Change Password
        $changePasswdForm = $this->createForm(new ChangePasswordType(), $User);
        
        if($Request->isMethod('POST') && $Request->request->has('changePassword')){
            $changePasswdForm->handleRequest($Request);
            
            if($changePasswdForm->isValid()){
                
                try {
                    $userManager = $this->get('user_manager');
                    $userManager->changePassword($User);

                    $this->get('session')->getFlashBag()->add('success', 'Twoje hasło zostało zmienione!');
                    return $this->redirect($this->generateUrl('rexi_user_profil'));
                    
                } catch (UserException $ex) {
                    $this->get('session')->getFlashBag()->add('error', $ex->getMessage());
                }
                
            }else{
                $this->get('session')->getFlashBag()->add('error', 'Popraw błędy formularza2!');
            }
        }
        
        return array(
            'accountSettingsForm' => $accountSettingsForm->createView(),
            'changePasswdForm' => $changePasswdForm->createView(),
        );
    }
}