<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Admin\Model\SegUsuariosModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $usuarios;

    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function testAction()
    {
        var_dump($this->usuarios->find(1));
        exit;
    }

    public function setUsuarios(SegUsuariosModel $usuarios)
    {
        $this->usuarios = $usuarios;
    }
}
