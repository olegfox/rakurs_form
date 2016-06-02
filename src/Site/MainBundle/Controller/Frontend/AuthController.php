<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Site\MainBundle\Entity\Client;
use Site\MainBundle\Form\ClientType;

class AuthController extends Controller
{
    public function registrationAction($register_date)
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $repository_settings = $this->getDoctrine()->getRepository('SiteMainBundle:Settings');

        $page = $repository->findOneBySlug('rieghistratsiia' . $register_date);
        $buklet = $repository->findOneBySlug('bukliet-uchastnika');
        $email = $repository_settings->findOneByKey('email');

        if ($email)
        {
            $email = $email->getValue();
        }

        $entity = new Client();
        $form   = $this->createCreateForm($entity, $register_date);

        $form->add('submit', 'submit', array(
            'label' => 'регистрация',
            'attr' => array(
                'class' => 'btn btn-default btn-lg',
                'ng-disabled' => '!site_mainbundle_client.$valid'         
            )
        ));

        if ($register_date == '14')
        {
            $form->remove('friends');
        } else {
            $form->remove('transport');
            $form->remove('meet');
            $form->remove('station');
            $form->remove('time');
        }


        return $this->render('SiteMainBundle:Frontend/Main:registration.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'page' => $page,
            'buklet' => $buklet,
            'email' => $email
        ));
    }

    private function createCreateForm(Client $entity, $register_date)
    {
        $form = $this->createForm(new ClientType(), $entity, array(
            'action' => $this->generateUrl('frontend_client_create', array(
                'register_date' => $register_date
            )),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.create'));

        return $form;
    }
}
