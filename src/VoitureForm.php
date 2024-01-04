<?php

namespace App;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class VoitureForm extends AbstractType
































{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('serie', TextType::class)
            ->add('date_mise_en_marche', DateType::class)
            ->add('modele', TextType::class);
    }
    public function getName(){
        return 'Voiture';
    }
}