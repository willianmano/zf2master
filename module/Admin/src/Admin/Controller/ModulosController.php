<?php

namespace Admin\Controller;

use Admin\Entity\SegModulos;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\SegModulosModel;
use Admin\Form\ModuloForm;

class ModulosController extends AbstractActionController
{
    protected $modulos;

    public function indexAction()
    {
        return new ViewModel(
            array(
                'modulos' => $this->modulos->findAll()
            )
        );
    }

    public function createAction()
    {
        $form = new ModuloForm();

        return new ViewModel(
            array('form' => $form)
        );
    }

    public function saveAction()
    {
        $form = new ModuloForm();

        $request = $this->getRequest();

        if ($request->isPost())
        {

            $modulosEntity = new SegModulos();

            $form->setInputFilter($modulosEntity->getInputFilter());
            $form->setData($request->getPost());

            if($form->isValid())
            {
                $this->modulos->save($form->getData());


                return $this->redirect()->toUrl('/admin/permissoes');
            }
        }

        return new ViewModel(
            array('form' => $form)
        );
    }
    public function setModulos(SegModulosModel $modulos)
    {
        $this->modulos = $modulos;
    }
}