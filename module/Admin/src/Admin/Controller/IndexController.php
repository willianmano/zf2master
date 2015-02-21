<?php
/**
 * Created by PhpStorm.
 * User: dev02
 * Date: 20/02/15
 * Time: 19:23
 */

namespace Admin\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}