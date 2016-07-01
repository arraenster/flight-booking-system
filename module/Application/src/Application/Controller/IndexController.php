<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        var_dump('INDEX');
        return new ViewModel();
    }

    public function testAction()
    {
        return new ViewModel();
    }
}
