<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Main\loginBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of QuizzType
 *
 * @author Gyordano
 */
class QuizzType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nome');
        $builder->add('questoes', CollectionType::class, array(
        'entry_type' => QuestaoType::class,
        'entry_options' => array('label' => false),
        'allow_add' => true,
        'by_reference' => false,
    ));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Main\loginBundle\Entity\Quizz',
        );
    }

    public function getName()
    {
        return 'quizz';
    }
}