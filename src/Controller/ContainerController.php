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

        $query = $this->params()->fromQuery();
        // $query['site_id'] = $site->id();
        $items = Array();
        $itemSets = $item->itemSets();
        if (count($itemSets) > 0): 
            foreach ($itemSets as $itemSet):         
                $query['item_set_id'] = $itemSet->id();
                $response = $this->api()->search('items', $query);
                $this->paginator($response->getTotalResults(), $this->params()->fromQuery('page'));
                $items = $response->getContent();
            endforeach;
        endif;


        $view = new ViewModel;
        $view->setVariable('site', $site);
        $view->setTerminal(true);
        $view->setVariable('item', $item);
        $view->setVariable('items', $items);
        $view->setVariable('resource', $item);


        return $view;
    }
}