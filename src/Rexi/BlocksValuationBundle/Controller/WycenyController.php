<?php

namespace Rexi\BlocksValuationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Rexi\BlocksValuationBundle\Form\Type\UserInfoType;

/**
 * @Route("/wyceny")
 */
class WycenyController extends Controller
{
    /**
     * @Route(
     *      "/uzupelnij",
     *      name = "rexi_wycen_uzupelnij",
     * )
     * @Template()
     */
    public function uzupelnijAction()
    {
        $userInfoForm = $this->createForm(new UserInfoType());
        return array(
            'form' => $userInfoForm->createView()
        );
    }
}
