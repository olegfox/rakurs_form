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
                    'ng-model' => 'client.fio',
                    'ng-minlength' => '3'
                )
            ))
            ->add('company', 'text', array(
                'required' => true,
                'label' => 'backend.client.company',
                'attr' => array(
                    'ng-model' => 'client.company',
                    'ng-minlength' => '3'
                )
            ))
            ->add('email', 'email', array(
                'required' => true,
                'label' => 'backend.client.email',
                'attr' => array(
                    'ng-model' => 'client.email',
                    'ng-minlength' => '5',
                    'placeholder' => 'На этот адрес придёт подтверждение регистрации'
                )
            ))
            ->add('hotel', 'entity', array(
                'required' => false,
                'class' => 'Site\MainBundle\Entity\Hotel',
                'label' => 'backend.client.hotel',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('h')
                        ->orderBy('h.position', 'ASC');
                },
                'empty_value' => 'backend.client.hotel.empty_value',
                'attr' => array(
                    'ng-model' => 'client.hotel'
                )
            ))
            ->add('classRoom', 'entity', array(
                'required' => false,
                'class' => 'Site\MainBundle\Entity\ClassRoom',
                'label' => 'backend.client.classRoom',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.position', 'ASC');
                },
                'empty_value' => 'backend.client.classRoom.empty_value',
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
                ),
                'empty_value' => 'backend.client.meet.empty_value',
            ))
            ->add('transport', 'choice', array(
                'required' => false,
                'label' => 'backend.client.transport',
                'choices' => array(
                    0 => 'Самолет',
                    1 => 'Поезд'
                ),
                'attr' => array(
                    'ng-model' => 'client.transport',
                ),
                'empty_value' => 'backend.client.transport.empty_value',
            ))
            ->add('time', 'time', array(
                'required' => false,
                'label' => 'backend.client.time',
                'widget' => 'single_text',
                'attr' => array(
                    'ng-model' => 'client.time',
                    'placeholder' => 'Укажите дату и время вашего прибытия для организации трансфера'
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
                'required' => false,
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
