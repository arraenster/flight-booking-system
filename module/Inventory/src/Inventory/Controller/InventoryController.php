<?php
namespace Inventory\Controller;

use Inventory\Entity\Flight;
use Inventory\Form\AddFlightForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Main flight-inventory controller
 *
 * @author: Vladyslav Semerenko <vladyslav.semerenko@gmail.com>
 */
class InventoryController extends AbstractActionController
{

    /**
     * @var ServiceManager
     */
    public $sm;

    /**
     * Show list of flights
     * @return ViewModel
     */
    public function indexAction()
    {

        $objectManager = $this->sm->get('Doctrine\ORM\EntityManager');

        $flightsObj = $objectManager->getRepository('\Inventory\Entity\Flight')
            ->findAll();

        $flights = [];
        foreach ($flightsObj as $flight) {
            $flights[] = $flight->getArrayCopy();
        }

        return new ViewModel([
            'flights' => $flights,
        ]);
    }

    /**
     * Add new flight
     * @return ViewModel
     */
    public function addAction()
    {

        $form = $this->sm->get('FormElementManager')
            ->get('AddFlightForm');

        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $formParams = $request->getPost();
            $form->setData($formParams);

            if ($form->isValid()) {

                $objectManager = $this->sm->get('Doctrine\ORM\EntityManager');

                $newFlight = new Flight();

                $newFlight->exchangeArray($form->getData());
                $newFlight->setFlightDate(new \DateTime($formParams['flightDate']));
                $newFlight->setId(0);

                $objectManager->persist($newFlight);
                $objectManager->flush();

                $this->flashMessenger()->addMessage("New flight successfully added");

                return $this->redirect()->toRoute('inventory');
            } else {
                $this->flashMessenger()->addErrorMessage("Error while saving flight");
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * Edit flight
     * @return ViewModel
     */
    public function editAction()
    {

        // Create form
        $form = $this->sm->get('FormElementManager')
            ->get('AddFlightForm');
        $form->get('submit')->setValue('Save');
        $request = $this->getRequest();

        if (!$request->isPost()) {

            // Check if id and flight exist
            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                $this->flashMessenger()->addErrorMessage('Flight id doesn\'t set');
                return $this->redirect()->toRoute('inventory');
            }

            $objectManager = $this->sm->get('Doctrine\ORM\EntityManager');
            $flightObj = $objectManager->getRepository('\Inventory\Entity\Flight')
                ->findOneBy(['id' => $id]);

            if (!$flightObj) {
                $this->flashMessenger()->addErrorMessage(sprintf('FLight #id %s doesn\'t exists', $id));
                return $this->redirect()->toRoute('inventory');
            }

            // Fill form data
            $form->bind($flightObj);

            return new ViewModel([
                'form' => $form
            ]);
        }
        else {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                $objectManager = $this->sm->get('Doctrine\ORM\EntityManager');
                $formParams = $form->getData();
                $id = $formParams['id'];

                try {
                    $flightObj = $objectManager->find('\Inventory\Entity\Flight', $id);
                }
                catch (\Exception $ex) {
                    return $this->redirect()->toRoute('inventory', ['action' => 'index']);
                }

                $flightObj->exchangeArray($form->getData());
                $flightObj->setFlightDate(new \DateTime($formParams['flightDate']));
                $objectManager->persist($flightObj);
                $objectManager->flush();

                $this->flashMessenger()->addMessage('Flight successfully saved!');

                return $this->redirect()->toRoute('inventory');
            }
            else {
                $this->flashMessenger()->addErrorMessage('Error while saving flight');
                return new ViewModel([
                    'form' => $form
                ]);
            }
        }
    }

    /**
     * Delete flight from table
     * @return ViewModel
     */
    public function deleteAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->flashMessenger()->addErrorMessage('Please define flight ID');
            return $this->redirect()->toRoute('inventory');
        }

        $objectManager = $this->sm->get('Doctrine\ORM\EntityManager');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {

                $id = (int) $request->getPost('id');
                try {
                    $blogpost = $objectManager->find('\Inventory\Entity\Flight', $id);
                    $objectManager->remove($blogpost);
                    $objectManager->flush();
                }
                catch (\Exception $ex) {
                    $this->flashMessenger()->addErrorMessage('Error while deleting flight');
                    return $this->redirect()->toRoute('inventory', [
                        'action' => 'index'
                    ]);
                }
                $this->flashMessenger()->addMessage(sprintf('Flight #%d was successfully deleted', $id));
            }
            return $this->redirect()->toRoute('inventory');
        }

        return new ViewModel([
            'id'        => $id,
            'flight'    => $objectManager->find('\Inventory\Entity\Flight', $id)->getArrayCopy(),
        ]);
    }
}
