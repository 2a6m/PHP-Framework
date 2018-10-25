<?php

namespace App\Form;

use App\Entity\Morceau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MorceauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      // https://symfony.com/doc/current/reference/forms/types.html
        $builder
            ->add('titre')
            ->add('duree')
            ->add('genre', ChoiceType::class, array('choices' => array(
                  'Electro-Swing'=>'Electro-Swing',
                  'Rock'=>'Rock',
                  'Pop'=>'Pop')))
            // create ChoiceType::class to choose between the existing artists
            ->add('artiste')
            ->add('date', DateType::class, array(
                    'widget' => 'single_text'))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Morceau::class,
        ]);
    }
}
