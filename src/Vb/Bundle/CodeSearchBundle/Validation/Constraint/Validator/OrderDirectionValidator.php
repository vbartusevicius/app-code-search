<?php

namespace Vb\Bundle\CodeSearchBundle\Validation\Constraint\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Vb\Bundle\CodeSearchBundle\Entity\Filter;
use Vb\Bundle\CodeSearchBundle\Validation\Constraint\OrderDirectionConstraint;

class OrderDirectionValidator extends ConstraintValidator
{
    /**
     * @param Filter $value
     * @param Constraint|OrderDirectionConstraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (
            $value->getOrderDirection() !== null
            && $value->getOrderBy() === null
        ) {
            $this->context->buildViolation($constraint->message)
                ->atPath('orderDirection')
                ->addViolation()
            ;
        }
    }
}
