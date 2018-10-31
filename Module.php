<?php
namespace Mirador;

use Omeka\Module\AbstractModule;
use Zend\EventManager\Event;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\Mvc\Controller\AbstractController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function uninstall(ServiceLocatorInterface $serviceLocator)
    {
        $settings = $serviceLocator->get('Omeka\Settings');
        $settings->delete('miradoor_properties');
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        // $sharedEventManager->attach(
        //     '*',
        //     'rep.resource.display_values',
        //     [$this, 'filterDisplayValues']
        // );
    }

}

