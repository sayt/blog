<?php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Date
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    protected $minDate;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    protected $maxDate;

    public function getMaxDate()
    {
        return $this->maxDate;
    }

    public function getMinDate()
    {
        return $this->minDate;
    }

    public function setMaxDate($maxDate)
    {
        $this->maxDate = $maxDate;
    }

    public function setMinDate($minDate)
    {
        $this->minDate = $minDate;
    }
}