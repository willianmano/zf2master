<?php

namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CrudController extends AbstractActionController
{
    protected $model;
    protected $form;
    protected $formFilter;
    protected $baseAction;

    public function indexAction()
    {
        $viewModel = new ViewModel(
            array(
                'resultSet' => $this->model->findAll()
            )
        );

        return $viewModel;
    }


    public function testAction()
    {
        var_dump($this->model->entityPrimaryKey);
    }

    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        // Se existir o ID exibe o form preenchido para atualizacao
        if($id) {
            $dataObject = $this->model->find($id);

            if(!$dataObject) {

                $this->flashMessenger()->setNamespace('error')->addMessage('Item não existe!');

                return $this->redirect()->toUrl($this->baseAction);
            }

            $this->form->setAttribute('action', $this->baseAction . '/update');
            $this->form->setData($dataObject->getArrayCopy());
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
                $dataObject = $this->model->find($data[$this->model->entityPrimaryKey]);

                $dataObject->exchangeArray($data);

                $this->model->save($modulo);

                $this->flashMessenger()->setNamespace('success')->addMessage('Item atualizado com sucesso!');

                return $this->redirect()->toUrl($this->baseAction);
            }
        }

        // Se nao existir ID nem for post eh um acesso ilegal e redireciona para a action principal do controller
        if(!$id && !$this->request->isPost()) {
            return $this->redirect()->toUrl($this->baseAction);
        }

        return new ViewModel(
            array('form' => $this->form)
        );
    }

    /**
     * @param BaseModel $model
     */
    public function setModel(\Core\Model\BaseModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param \Zend\Form\Form $form
     */
    public function setForm(\Zend\Form\Form $form)
    {
        $this->form = $form;
    }

    /**
     * @param \Zend\InputFilter\InputFilter $formFilter
     */
    public function setFormFilter(\Zend\InputFilter\InputFilter $formFilter)
    {
        $this->formFilter = $formFilter;
    }

    /**
     * @param string $baseAction
     */
    public function setBaseAction($baseAction)
    {
        $this->baseAction = $baseAction;
    }

}