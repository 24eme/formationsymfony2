<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PronosticType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('utilisateur')
            ->add('scoreA', TextType::class)
            ->add('scoreB', TextType::class)
            //->add('date', 'datetime')
            ->add('nbCafes', TextType::class)
            //->add('rencontre')
        ;

        if($options['utilisateur_editable']){
          $builder->add('utilisateur');
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pronostic',
            'utilisateur_editable' => false
        ));
    }
}
