<?php

namespace App\Form;

use App\Entity\Morceau;
use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MorceauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('duree', TimeType::class, array(
                'input' => 'datetime',
            ))
            ->add('genre', Choicetype::class, array(
                'choices' => array(
                    'Electro-Swing' => 'Electro-Swing',
                    'Rock' => 'Rock',
                    'Pop' => 'Pop',
                )
            ))
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
            ))
            ->add('artiste', EntityType::class, array(
                'class' => Artiste::class,
                'choice_label' => 'nom',
                'choice_value' => 'id',
            ))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Morceau::class,
        ]);
    }

    public function isValid()
    {
        $errors = $validator->validate($this);

        return (count($errors) > 0);
    }
}
