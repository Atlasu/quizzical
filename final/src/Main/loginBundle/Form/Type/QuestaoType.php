<?php

namespace Main\loginBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Description of QuestaoType
 *
 * @author Gyordano
 */
class QuestaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('enunciado', TextareaType::class, array('label' => 'Enunciado'));
        $builder->add('alta', null, array('label' => 'a)'));
        $builder->add('altb', null, array('label' => 'b)'));
        $builder->add('altc', null, array('label' => 'c)'));
        $builder->add('altd', null, array('label' => 'd)'));
        $builder->add('answer', ChoiceType::class, array(
            'choices'  => array(
                'a' => 'A',
                'b' => 'B',
                'c' => 'C',
                'd' => 'D',
            ),
        ));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Main\loginBundle\Entity\Questao',
        );
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Main\loginBundle\Entity\Questao',
        ));
    }

    public function getName()
    {
        return 'questao';
    }
}