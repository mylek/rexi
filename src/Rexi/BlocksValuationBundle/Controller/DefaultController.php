<?php

namespace Rexi\BlocksValuationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/panel/bloki")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
