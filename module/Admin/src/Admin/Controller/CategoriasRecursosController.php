<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoriasRecursosController extends AbstractActionController
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

                $this->flashMessenger()->setNamespace('success')->addMessage('Categoria de recurso cadastrada com sucesso!');

                return $this->redirect()->toUrl('/admin/categoriasrecursos');
            }
        }

        return new ViewModel(
            array('form' => $this->form)
        );
    }

    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        $this->form->setAttribute('action', '/admin/categoriasrecursos/update');

        // Se existir o ID exibe o form preenchido para atualizacao
        if($id) {
            $categoriaRecurso = $this->model->find($id);

            if(!$categoriaRecurso) {

                $this->flashMessenger()->setNamespace('error')->addMessage('Categoria não existe!');

                return $this->redirect()->toUrl('/admin/categoriasrecursos');
            }

            $this->form->setData($categoriaRecurso->getArrayCopy());
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
                $categoriaRecurso = $this->model->find($data['ctrId']);

                $categoriaRecurso->exchangeArray($data);

                $this->model->save($categoriaRecurso);

                $this->flashMessenger()->setNamespace('success')->addMessage('Categoria atualizada com sucesso!');

                return $this->redirect()->toUrl('/admin/categoriasrecursos');
            }
        }

        // Se nao existir ID nem for post eh um acesso ilegal e redireciona para a action principal do controller
        if(!$id && !$this->request->isPost()) {
            return $this->redirect()->toUrl('/admin/categoriasrecursos');
        }

        return new ViewModel(
            array('form' => $this->form)
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        if($id) {
            $categoriaR = $this->model->find($id);

            if(!$categoriaR) {
                $this->flashMessenger()->setNamespace('error')->addMessage('Módulo não existe!');

                return $this->redirect()->toUrl('/admin/modulos');
            }

            $this->model->delete($categoriaR);

            $this->flashMessenger()->setNamespace('success')->addMessage('Módulo excluído com sucesso!');
        }

        return $this->redirect()->toUrl('/admin/modulos');
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @param mixed $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    /**
     * @param mixed $formFilter
     */
    public function setFormFilter($formFilter)
    {
        $this->formFilter = $formFilter;
    }
}