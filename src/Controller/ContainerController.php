<?php

/*
 * Copyright 2018 Brumfield Labs, LLC
 *
 */

namespace Mirador\Controller;

use Omeka\Mvc\Exception\NotFoundException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContainerController extends AbstractActionController
{


    public function console_log( $data ){
      echo '<script>';
      echo 'console.log('. json_encode( $data ) .')';
      echo '</script>';
    }

    /**
     * Forward to the 'play' action
     *
     * @see self::playAction()
     */
    public function indexAction()
    {
        $this->forward('mirador');
    }

    public function miradorAction()
    {
        $site = $this->currentSite();
        $response = $this->api()->read('items', $this->params('id'));
        $item = $response->getContent();

        $view = new ViewModel;
        $view->setVariable('site', $site);
        $view->setTerminal(true);
        $view->setVariable('item', $item);
        $view->setVariable('resource', $item);
        return $view;
    }
}