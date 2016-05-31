<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fio', 'text', array(
                'required' => true,
                'label' => 'backend.client.fio'
            ))
            ->add('company', 'text', array(
                'required' => true,
                'label' => 'backend.client.company'
            ))
            ->add('email', 'email', array(
                'required' => true,
                'label' => 'backend.client.email'
            ))
            ->add('hotel', 'entity', array(
                'required' => true,
                'class' => 'Site\MainBundle\Entity\Hotel',
                'label' => 'backend.client.hotel',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('h')
                        ->orderBy('h.position', 'ASC');
                }
            ))
            ->add('classRoom', 'entity', array(
                'required' => true,
                'class' => 'Site\MainBundle\Entity\ClassRoom',
                'label' => 'backend.client.classRoom',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.position', 'ASC');
                }
            ))
            ->add('meet', 'choice', array(
                'required' => true,
                'label' => 'backend.client.meet',
                'choices' => array(
                    0 => 'Нет',
                    1 => 'Да'
                )
            ))
            ->add('transport', 'choice', array(
                'required' => true,
                'label' => 'backend.client.transport',
                'choices' => array(
                    0 => 'Самолет',
                    1 => 'Поезд'
                )
            ))
            ->add('station', 'entity', array(
                'required' => true,
                'class' => 'Site\MainBundle\Entity\Stations',
                'label' => 'backend.client.station',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.position', 'ASC');
                }
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Client',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_client';
    }
}
