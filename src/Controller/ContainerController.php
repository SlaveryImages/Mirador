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
        $id = $this->params('id');
        if (empty($id)) {
            throw new NotFoundException;
        }

        // Map iiif resources with Omeka Classic and Omeka S records.
        $matchingResources = [
            'item' => 'items',
            'items' => 'items',
            'item-set' => 'item_sets',
            'item-sets' => 'item_sets',
            'item_set' => 'item_sets',
            'item_sets' => 'item_sets',
            'collection' => 'item_sets',
            'collections' => 'item_sets',
        ];
        $resourceName = $this->params('resourcename');
        if (!isset($matchingResources[$resourceName])) {
            throw new NotFoundException;
        }
        $resourceName = $matchingResources[$resourceName];

        $response = $this->api()->read($resourceName, $id);
        $resource = $response->getContent();
        if (empty($resource)) {
            throw new NotFoundException;
        }

        $view = new ViewModel;
        $view->setVariable('id', $id);
        $view->setVariable('item', $resource);
        $view->setVariable('resourceName', $resourceName);

	    $view->setTerminal(true);
        return $view;
        // return $this->jsonLd("HELLO");
    }
}