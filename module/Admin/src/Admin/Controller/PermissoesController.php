<?php

namespace Admin\Controller;

use Admin\Model\SegPermissoesModel;
use Admin\Model\SegModulosModel;
use Admin\Model\SegRecursosModel;
use Admin\Form\PermissaoForm;
use Admin\Form\Filter\PermissaoFormFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class PermissoesController extends AbstractActionController
{
    protected $model;
    protected $form;
    protected $formFilter;

    protected $modulosModel;
    protected $recursosModel;

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
                $data['prmRcs'] = $this->recursosModel->find($data['prmRcs']);
                $this->model->save($data);

                $this->flashMessenger()->setNamespace('success')->addMessage('Permissão cadastrada com sucesso!');

                return $this->redirect()->toUrl('/admin/permissoes');
            }

            if($modulo = $this->modulosModel->find($data['prmModulo'])) {
                if(count($modulo->recursos)) {
                    foreach ($modulo->recursos as $recurso) {
                        $recursos[$recurso->rcsId] = $recurso->rcsNome;
                    }
                    //popula o select com os modulos
                    $this->form->get('prmRcs')->setValueOptions($recursos);
                }
            }
        }

        //popula o select com os modulos
        $this->form->get('prmModulo')->setValueOptions($this->modulosModel->getAllItensToSelect('modId', 'modNome'));

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
            $permissao = $this->model->find($id);

            if(!$permissao) {

                $this->flashMessenger()->setNamespace('error')->addMessage('Permissão não existe!');

                return $this->redirect()->toUrl('/admin/permissoes');
            }

            //popula o select com os modulos
            $this->form->get('prmModulo')->setValueOptions($this->modulosModel->getAllItensToSelect('modId', 'modNome'));

            $this->form->setData($permissao->getArrayCopy());
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
                $permissao = $this->model->find($data['prmId']);

                $permissao->exchangeArray($data);

                $this->model->save($permissao);

                $this->flashMessenger()->setNamespace('success')->addMessage('Permissão atualizada com sucesso!');

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
            $permissao = $this->model->find($id);

            if(!$permissao) {
                $this->flashMessenger()->setNamespace('error')->addMessage('Permissão não existe!');

                return $this->redirect()->toUrl('/admin/permissoes');
            }

            $this->model->delete($permissao);

            $this->flashMessenger()->setNamespace('success')->addMessage('Permissão excluída com sucesso!');
        }

        return $this->redirect()->toUrl('/admin/permissoes');
    }

    //ASYNC Methods
    public function asyncgetrecursosbymoduloAction()
    {
        $id = (int) $this->params()->fromRoute('id');

        if(!$id || !$modulo = $this->modulosModel->find($id)) {
            return new JsonModel(array('status' => 'error'));
        }

        if(empty($modulo->recursos)) {
            new JsonModel(array());
        }

        foreach ($modulo->recursos as $recurso) {
            $returData[] = array('rcsId' => $recurso->rcsId, 'rcsNome' => $recurso->rcsNome);
        }

        return new JsonModel($returData);
    }


    // SETTERs
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

    /**
     * @param SegPermissoesModel $permissoes
     */
    public function setModel(SegPermissoesModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param SegModulosModel $modulosModel
     */
    public function setModulosModel(SegModulosModel $modulosModel)
    {
        $this->modulosModel = $modulosModel;
    }

    /**
     * @param SegRecursosModel $recursosModel
     */
    public function setRecursosModel($recursosModel)
    {
        $this->recursosModel = $recursosModel;
    }
}