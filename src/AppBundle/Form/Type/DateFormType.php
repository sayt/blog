<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("minDate", DateType::class, array("label" => "Mettől"))
            ->add("maxDate", DateType::class, array("label" => "Meddig"))
            ->add("keres", SubmitType::class, array("label" => "Keresés"))
        ;
    }
}