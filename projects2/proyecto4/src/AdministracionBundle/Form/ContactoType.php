<?php

namespace AdministracionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('longitudValidacion')
            ->add('digitosValidacion')
            //->add('usuarioCreacion')
            //->add('fechaCreacion')
            //->add('usuarioActualizacion')
            //->add('fechaActualizacion')
            ->add('idTipoContacto');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdministracionBundle\Entity\Contacto'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'administracionbundle_contacto';
    }


}
