<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PronosticType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('utilisateur')
            ->add('scoreA', null, array('attr' => array('placeholder' => "Score de l'équipe A"), 'label' => "Score de l'équipe A"))
            ->add('scoreB')
            //->add('date', 'datetime')
            ->add('nbCafe')
            //->add('rencontre')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pronostic'
        ));
    }
}
