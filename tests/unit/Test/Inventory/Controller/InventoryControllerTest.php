<?php
namespace Test\Inventory\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Dom\Query;
/**
 * @coversDefaultClass Inventory\Controller\InventoryController
 * @author: Vladyslav Semerenko <vladyslav.semerenko@gmail.com>
 */
class InventoryControllerTest extends AbstractHttpControllerTestCase
{

    public function setUp()
    {

        $this->setApplicationConfig(
            include './config/application.config.php'
        );
        parent::setUp();
    }

    /**
     * @covers ::indexAction
     */
    public function testIndexActionReturnViewModel()
    {

        $this->dispatch('/inventory');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Inventory');
        $this->assertControllerName('Inventory\Controller\Inventory');
        $this->assertControllerClass('InventoryController');
        $this->assertMatchedRouteName('inventory');
    }

    /**
     * @covers ::addAction
     */
    public function testAddActionRedirectsAfterValidPost()
    {

        $entityManagerMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $entityManagerMock->expects($this->once())
            ->method('persist')
            ->will($this->returnValue(null));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('Doctrine\ORM\EntityManager', $entityManagerMock);

        $this->dispatch('/inventory/add');

        // fetch content of the page
        $html = $this->getResponse()->getBody();

        // parse page content, find the hash value prefilled to the hidden element
        $dom = new Query($html);
        $csrf = $dom->execute('input[name="security"]')->current()->getAttribute('value');

        $postData = array(
            'id'            => '',
            'security'      => $csrf,
            'origin'        => 'Kyiv',
            'destination'   => 'berlin',
            'flightDate'    => '2011-01-01 00:00:00',
            'flightNumber'  => 1234,
            'airline'       => 'Air Berlin',
            'aircraft'      => 'B737',
            'availability'  => 150,
            'price'         => 10
        );
        $this->dispatch('/inventory/add', 'POST', $postData);
        $this->assertResponseStatusCode(302);

        $this->assertRedirectTo('/inventory');
    }
}