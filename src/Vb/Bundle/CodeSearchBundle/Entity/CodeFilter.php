<?php

namespace Vb\Bundle\CodeSearchBundle\Entity;

use Paysera\Component\Serializer\Entity\Filter;

class CodeFilter extends Filter
{
    private $term;

    /**
     * @return string|null
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param string|null $term
     *
     * @return $this
     */
    public function setTerm($term)
    {
        $this->term = $term;
        return $this;
    }
}
