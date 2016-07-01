<?php
namespace Inventory\Form\Validator;

use Zend\Validator\AbstractValidator;

/**
 * Custom float validator
 * @author: Vladyslav Semerenko <vladyslav.semerenko@gmail.com>
 */
class Float extends AbstractValidator
{
    const FLOAT = 'float';

    protected $messageTemplates = array(
        self::FLOAT => "'%value%' is not a floating point value"
    );

    public function isValid($value)
    {
        $this->setValue($value);

        if (!preg_match('/^[0-9]+[.,]?[0-9]+/', $value)) {
            $this->error(self::FLOAT);
            return false;
        }

        return true;
    }
}