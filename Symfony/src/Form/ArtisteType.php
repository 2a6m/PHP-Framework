<?php

namespace App\Form;

use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ArtisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('date_naissance', DateType::class, array(
                    'widget' => 'single_text'))
            ->add('genre', ChoiceType::class, array('choices' => array(
                  'Electro-Swing'=>'Electro-Swing',
                  'Rock'=>'Rock',
                  'Pop'=>'Pop')))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artiste::class,
        ]);
    }

    public function isValid()
    {
        $validator = new ValidatorInterface();
        $errors = $validator->validate($this);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            //$errorsString = (string) $errors;

            //return new Response($errorsString);
            return (False);
        }
        else {
            return (True);
        }
    }

}
