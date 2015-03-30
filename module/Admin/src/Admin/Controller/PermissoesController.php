<?php

namespace Admin\Controller;

use Admin\Model\SegPermissoesModel;
use Admin\Form\PermissaoForm;
use Admin\Form\Filter\PermissaoFormFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PermissoesController extends AbstractActionController
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
                $this->model->save($data);

                $this->flashMessenger()->setNamespace('success')->addMessage('Permissão cadastrado com sucesso!');

                return $this->redirect()->toUrl('/admin/permissoes');
            }
        }

        return new ViewModel(
            array('form' => $this->form)
        );
    }

    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        $this->form->setAttribute('action', '/admin/permissoes/update');

        // Se existir o ID exibe o form preenchido para atualizacao
        if($id) {
            $modulo = $this->model->find($id);

            if(!$modulo) {

                $this->flashMessenger()->setNamespace('error')->addMessage('Permissão não existe!');

                return $this->redirect()->toUrl('/admin/permissoes');
            }

            $this->form->setData($modulo->getArrayCopy());
        }

        // Se o metodo for post salva as informacoes com os dados preenchidos no form
        if ($this->request->isPost())
        {
            $data = $this->params()->fromPost();
            $this->form->setData($data);

            $this->formFilter->prepareFilters();
            $this->form->setInputFilter($this->formFilter);

            if($this->form->isValid($data))
            {
                $modulo = $this->model->find($data['prmId']);

                $modulo->exchangeArray($data);

                $this->model->save($modulo);

                $this->flashMessenger()->setNamespace('success')->addMessage('Permissão atualizado com sucesso!');

                return $this->redirect()->toUrl('/admin/permissoes');
            }
        }

        // Se nao existir ID nem for post eh um acesso ilegal e redireciona para a action principal do controller
        if(!$id && !$this->request->isPost()) {
            return $this->redirect()->toUrl('/admin/permissoes');
        }

        return new ViewModel(
            array('form' => $this->form)
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        if($id) {
            $modulo = $this->model->find($id);

            if(!$modulo) {
                $this->flashMessenger()->setNamespace('error')->addMessage('Permissão não existe!');

                return $this->redirect()->toUrl('/admin/permissoes');
            }

            $this->model->delete($modulo);

            $this->flashMessenger()->setNamespace('success')->addMessage('Permissão excluído com sucesso!');
        }

        return $this->redirect()->toUrl('/admin/permissoes');
    }

    /**
     * @param SegPermissoesModel $permissoes
     */
    public function setModel(SegPermissoesModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param PermissaoForm $form
     */
    public function setForm(PermissaoForm $form)
    {
        $this->form = $form;
    }

    /**
     * @param PermissaoFormFilter $formFilter
     */
    public function setFormFilter(PermissaoFormFilter $formFilter)
    {
        $this->formFilter = $formFilter;
    }
}