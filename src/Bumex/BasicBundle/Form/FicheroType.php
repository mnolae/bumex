<?php

namespace Bumex\BasicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FicheroType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('file', 'file', array('label' => 'fichero'));
        $builder->add('fecha', 'date', array('label' => 'fecha', 'format' => 'dd-MM-yyyy'));
    }
    
    public function getName()
    {
        return 'fichero';
    }
}
