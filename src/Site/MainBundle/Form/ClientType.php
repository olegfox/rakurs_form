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
                'label' => 'backend.client.fio',
                'attr' => array(
                    'ng-model' => 'client.fio'
                )
            ))
            ->add('company', 'text', array(
                'required' => true,
                'label' => 'backend.client.company',
                'attr' => array(
                    'ng-model' => 'client.company'
                )
            ))
            ->add('email', 'email', array(
                'required' => true,
                'label' => 'backend.client.email',
                'attr' => array(
                    'ng-model' => 'client.email'
                )
            ))
            ->add('hotel', 'entity', array(
                'required' => true,
                'class' => 'Site\MainBundle\Entity\Hotel',
                'label' => 'backend.client.hotel',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('h')
                        ->orderBy('h.position', 'ASC');
                },
                'attr' => array(
                    'ng-model' => 'client.hotel'
                )
            ))
            ->add('classRoom', 'entity', array(
                'required' => true,
                'class' => 'Site\MainBundle\Entity\ClassRoom',
                'label' => 'backend.client.classRoom',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.position', 'ASC');
                },
                'attr' => array(
                    'ng-model' => 'client.classRoom'
                )
            ))
            ->add('meet', 'choice', array(
                'required' => true,
                'label' => 'backend.client.meet',
                'choices' => array(
                    0 => 'Нет',
                    1 => 'Да'
                ),
                'attr' => array(
                    'ng-model' => 'client.meet'
                )
            ))
            ->add('transport', 'choice', array(
                'required' => true,
                'label' => 'backend.client.transport',
                'choices' => array(
                    0 => 'Самолет',
                    1 => 'Поезд'
                ),
                'attr' => array(
                    'ng-model' => 'client.transport',
                )
            ))
            ->add('time', 'datetime', array(
                'required' => true,
                'label' => 'backend.client.time',
                'attr' => array(
                    'ng-model' => 'client.time'
                )
            ))
            ->add('station', 'entity', array(
                'required' => false,
                'class' => 'Site\MainBundle\Entity\Stations',
                'label' => 'backend.client.station',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.position', 'ASC');
                },
                'attr' => array(
                    'ng-model' => 'client.station',
                    'ng-show' => 'client.transport == 1'
                ),
                'label_attr' => array(
                    'ng-show' => 'client.transport == 1'
                )
            ))
            ->add('friends', 'textarea', array(
                'required' => true,
                'label' => 'backend.client.friends',
                'attr' => array(
                    'ng-model' => 'client.friends'
                )
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
