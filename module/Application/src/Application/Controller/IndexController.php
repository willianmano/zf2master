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
//        find id 1
//        var_dump($this->usuarios->find(1));

//        find all
//        var_dump($this->usuarios->findAll());

//        Save a new object
//        $usuario['usrNome'] = 'Usuário teste';
//        $usuario['usrEmail'] = 'email@teste.com';
//        $usuario['usrTelefone'] = '(98)98877-7515';
//        $usuario['usrUsuario'] = 'teste';
//        $usuario['usrSenha'] = 'senhateste';
//        $entity = $this->usuarios->save($usuario);
//        var_dump($entity);

//        Update a object
//        $entity = $this->usuarios->find(1);
//        $entity->usrNome = 'Willian OPA';
//        $this->usuarios->save($entity);

//        Update a object from an array
//        $usuario['usrNome'] = 'Willian OP';
//        $usuario['usrEmail'] = 'willian@email.com';
//        $entity = $this->usuarios->find(1);
//        $entity->exchangeArray($usuario);
//        $this->usuarios->save($entity);

//        Delete an database entry
//        $entity = $this->usuarios->delete(10);

        var_dump($entity);

        exit;
    }

    public function setUsuarios(SegUsuariosModel $usuarios)
    {
        $this->usuarios = $usuarios;
    }
}
