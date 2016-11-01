<?php

namespace Rexi\DashBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerInterface;


class CoreController extends Controller {
    protected $breadcrumbs = null;
    
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->breadcrumbs = $this->get("white_october_breadcrumbs");
        $this->breadcrumbs->addItem("Pulpit", $this->get("router")->generate("rexi_dashboard"));
    }
}
