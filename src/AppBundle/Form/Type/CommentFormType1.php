<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CommentFormType1 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, array("label" => "Név:"))
            ->add("szoveg", TextType::class, array("label" => "Hozzászolás:"))
            ->add("email", TextType::class, array("label" => "Email:"))
            ->add("upload", SubmitType::class, array("label" => "Comment létrehozása"))
        ;
    }

}