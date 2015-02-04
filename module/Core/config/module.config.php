<?php
return array(
    'view_helpers' => array(
        'invokables'=> array(
            'elementToRow' => 'Core\View\Helper\ElementToRow'
        ),
        'factories' => array(
            'flashMessage' => function($serviceManager) {
                $flashMessenger = $serviceManager->getServiceLocator()->get('ControllerPluginManager')->get('flashmessenger');
                $message = new Core\View\Helper\FlashMessage();
                $message->setFlashMessenger( $flashMessenger );

                return $message ;
            }
        )
    ),
);