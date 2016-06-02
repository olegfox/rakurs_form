<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Site\MainBundle\Entity\Client;
use Site\MainBundle\Form\ClientType;

class AuthController extends Controller
{
    public function registrationAction(Request $request, $register_date)
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $repository_settings = $this->getDoctrine()->getRepository('SiteMainBundle:Settings');

        $page = $repository->findOneBySlug('rieghistratsiia' . $register_date);
        $buklet = $repository->findOneBySlug('bukliet-uchastnika');
        $email = $repository_settings->findOneByKey('email');
        $timer = $repository_settings->findOneByKey('timer' . $register_date)->getValue();

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
            $entity->setRegisterDate(0);
        } else {
            $form->remove('transport');
            $form->remove('meet');
            $form->remove('station');
            $form->remove('time');
            $entity->setRegisterDate(1);
        }

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $swift = \Swift_Message::newInstance()
                    ->setSubject('Ракурс')
                    ->setFrom(array($this->container->getParameter('email_from') => "Ракурс"))
                    ->setTo($entity->getEmail())
                    ->setBody(
                        $this->renderView(
                            'SiteMainBundle:Frontend/Email:index.html.twig',
                            array(
                                'form' => $entity
                            )
                        )
                        , 'text/html'
                    );

                $this->get('mailer')->send($swift);

                if ($request->get('xhr'))
                {
                    return new Response('', 200);
                }
                else
                {
                    return $this->redirect($this->generateUrl('frontend_register_index', array('register_date' => $register_date)));
                }
            }

            die(var_dump($form->getErrors()));

        }

        return $this->render('SiteMainBundle:Frontend/Main:registration.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'page' => $page,
            'buklet' => $buklet,
            'email' => $email,
            'timer' => $timer
        ));
    }

    private function createCreateForm(Client $entity, $register_date)
    {
        $form = $this->createForm(new ClientType(), $entity, array(
            'action' => $this->generateUrl('frontend_register_index', array(
                'register_date' => $register_date
            )) . '?xhr=true',
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.create'));

        return $form;
    }
}
