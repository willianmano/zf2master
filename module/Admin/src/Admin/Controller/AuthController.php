<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\LoginForm;

class AuthController extends AbstractActionController
{
    protected $form;
    protected $serviceManager;

    public function indexAction()
    {
        return new ViewModel(array(
            'form' => $this->form
        ));
    }

    public function loginAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            $this->flashMessenger()->setNamespace('error')->addMessage('Acesso proibido!');

            return $this->redirect()->toUrl('/admin/auth');
        }


        $data = $request->getPost();
        $service = $this->serviceManager->get('Admin\Service\AuthService');

        $auth = $service->authenticate(
            array(
                'usrUsuario' => $data['usrUsuario'],
                'usrSenha' => $data['usrSenha']
            )
        );

        if ($auth) {
            return $this->redirect()->toUrl('/');
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage('Usuário e/ou senha inválido(s)');

            return $this->redirect()->toUrl('/admin/auth');
        }
    }

    public function logoutAction()
    {
        $service = $this->serviceManager->get('Admin\Service\AuthService');
        $auth = $service->logout();

        return $this->redirect()->toUrl('/');
    }

    /**
     * @param mixed $form
     */
    public function setForm(LoginForm $form)
    {
        $this->form = $form;
    }

    /**
     * @param mixed $serviceManager
     */
    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }
}
