<?php

namespace Vb\Bundle\CodeSearchBundle\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Vb\Bundle\CodeSearchBundle\Validation\Constraint\Validator\OrderDirectionValidator;

class OrderDirectionConstraint extends Constraint
{
    public $message = 'Order Direction must be used only with Order By';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return OrderDirectionValidator::class;
    }
}
