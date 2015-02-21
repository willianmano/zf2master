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