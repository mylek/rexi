<?php

namespace Rexi\DashBoardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/panel")
 */
class DefaultController extends CoreController
{
    /**
     * @Route(
     * "/",
     * name="rexi_dashboard",
     * )
     * @Template()
     */
    public function indexAction()
    {
        
        return array();
    }
}
