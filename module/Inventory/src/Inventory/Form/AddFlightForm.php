<?php
namespace Inventory\Form;

use Inventory\Form\Filter\AddFlightInputFilter;
use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Add new flight form
 * Implements filters
 *
 * @author: Vladyslav Semerenko <vladyslav.semerenko@gmail.com>
 */
class AddFlightForm extends Form implements InputFilterProviderInterface
{

    public function __construct($name = null)
    {
        parent::__construct('addflight');
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new AddFlightInputFilter());
        $this->add(array(
            'name' => 'security',
            'type' => 'Zend\Form\Element\Csrf',
        ));
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'origin',
            'type' => 'Text',
            'options' => array(
                'min' => 3,
                'max' => 25,
                'label' => 'Origin',
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'destination',
            'type' => 'Text',
            'options' => array(
                'min' => 3,
                'max' => 25,
                'label' => 'Destination',
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'flightDate',
            'type' => 'DateTime',
            'options' => array(
                'format' => 'Y-m-d H:i:s',
                'label' => 'Flight date',
            ),
            'attributes' => array(
                'step' => '1',
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'airline',
            'type' => 'Text',
            'options' => array(
                'min' => 3,
                'max' => 25,
                'label' => 'Airline',
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'aircraft',
            'type' => 'Text',
            'options' => array(
                'min' => 3,
                'max' => 25,
                'label' => 'Aircraft',
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'flightNumber',
            'type' => 'Text',
            'options' => array(
                'min' => 3,
                'max' => 25,
                'label' => 'Flight number',
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'availability',
            'required' => true,
            'filters'  => array(
                array('name' => 'Int'),
            ),
            'options' => array(
                'label' => 'Availability',
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'price',
            'options' => array(
                'label' => 'Price',
            ),
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Float',
                    'options' => array(
                        'min' => 0,
                        'locale' => 'utf8'
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Add',
                'id' => 'submitbutton',
                'class' => 'btn btn-default'
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            array(
                'name' => 'price',
                'required' => true,
                'validators' => array(
                    array('name' => 'FloatValidator'),
                ),
            ),
        );
    }
}