<?php

namespace Admin\Controller;

use Admin\Model\SegUsuariosModel;
use Admin\Form\UsuarioForm;
use Admin\Form\Filter\UsuarioFormFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Crypt\Password\Bcrypt;

class UsuariosController extends AbstractActionController
{
    protected $model;
    protected $form;
    protected $formFilter;

    public function indexAction()
    {
        return new ViewModel(
            array(
                'resultSet' => $this->model->findAll()
            )
        );
    }

    public function createAction()
    {
        if ($this->request->isPost())
        {
            $data = $this->params()->fromPost();

            $this->formFilter->prepareFilters();
            $this->form->setInputFilter($this->formFilter);
            $this->form->setData($data);

            if($this->form->isValid())
            {

                $bcrypt = new Bcrypt();
                $data['usrSenha'] = $bcrypt->create($data['usrSenha']);

                $this->model->save($data);

                $this->flashMessenger()->setNamespace('success')->addMessage('Usuário cadastrado com sucesso!');

                return $this->redirect()->toUrl('/admin/usuarios');
            }
        }

        return new ViewModel(
            array('form' => $this->form)
        );
    }

    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        $this->form->setAttribute('action', '/admin/usuarios/update');

        // Se existir o ID exibe o form preenchido para atualizacao
        if($id) {
            $usuario = $this->model->find($id);
            $usuario->usrSenha = '';

            if(!$usuario) {

                $this->flashMessenger()->setNamespace('error')->addMessage('Usuário não existe!');

                return $this->redirect()->toUrl('/admin/usuarios');
            }

            $this->form->setData($usuario->getArrayCopy());
        }

        // Se o metodo for post salva as informacoes com os dados preenchidos no form
        if ($this->request->isPost())
        {
            $data = $this->params()->fromPost();
            $this->form->setData($data);

            $this->formFilter->prepareFilters();

            if(!$data['usrSenha']) {
                $this->formFilter->remove('usrSenha');
            }

            $this->form->setInputFilter($this->formFilter);

            if($this->form->isValid($data))
            {
                $usuario = $this->model->find($data['usrId']);

                $senhaAntiga = $usuario->usrSenha;

                $usuario->exchangeArray($data);

                if($data['usrSenha']) {
                    $bcrypt = new Bcrypt();
                    $usuario->usrSenha = $bcrypt->create($data['usrSenha']);
                } else {
                    $usuario->usrSenha = $senhaAntiga;
                }

                $this->model->save($usuario);

                $this->flashMessenger()->setNamespace('success')->addMessage('Usuário atualizado com sucesso!');

                return $this->redirect()->toUrl('/admin/usuarios');
            }
        }

        // Se nao existir ID nem for post eh um acesso ilegal e redireciona para a action principal do controller
        if(!$id && !$this->request->isPost()) {
            return $this->redirect()->toUrl('/admin/usuarios');
        }

        return new ViewModel(
            array('form' => $this->form)
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        if($id) {
            $usuario = $this->model->find($id);

            if(!$usuario) {
                $this->flashMessenger()->setNamespace('error')->addMessage('Usuário não existe!');

                return $this->redirect()->toUrl('/admin/usuarios');
            }

            $this->model->delete($usuario);

            $this->flashMessenger()->setNamespace('success')->addMessage('Usuário excluído com sucesso!');
        }

        return $this->redirect()->toUrl('/admin/usuarios');
    }

    /**
     * @param SegUsuariosModel $usuarios
     */
    public function setModel(SegUsuariosModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param UsuarioForm $form
     */
    public function setForm(UsuarioForm $form)
    {
        $this->form = $form;
    }

    /**
     * @param UsuarioFormFilter $formFilter
     */
    public function setFormFilter(UsuarioFormFilter $formFilter)
    {
        $this->formFilter = $formFilter;
    }
}