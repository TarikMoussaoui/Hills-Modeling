<?php

namespace HillsModeling\FrontEndBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MembreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->remove('username');
        $builder->add('nom');
        $builder->add('prenom');

        $builder->add('civilisation', ChoiceType::class, array(
            'choices'  => array(
                ''=>'',
                'Homme' => "Homme",
                'Femme' => "Femme",
            ),
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HillsModeling\FrontEndBundle\Entity\Membre'
        ));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'HillsModeling_frontendbundle_Membre';
    }


}
