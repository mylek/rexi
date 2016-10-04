<?php

namespace Rexi\BlocksValuationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        return array();
    }
}
