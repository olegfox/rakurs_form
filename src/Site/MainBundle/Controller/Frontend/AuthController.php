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
        $map = $repository_settings->findOneByKey('map');
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
            $form->remove('hotel');
            $form->remove('classRoom');
            $form->remove('meet');
            $form->remove('transport');
            $form->remove('station');
            $form->remove('time');
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

                $emails_to = array(
                    $entity->getEmail()
                );

                $emails_to = array_merge($emails_to, explode(",", $this->container->getParameter('email_to')));

                foreach($emails_to as $email) {

                    $swift = \Swift_Message::newInstance()
                        ->setSubject('Ракурс')
                        ->setFrom(array($this->container->getParameter('email_from') => "Ракурс"))
                        ->setTo($email)
                        ->setBody(
                            $this->renderView(
                                'SiteMainBundle:Frontend/Email:index' . $register_date . '.html.twig',
                                array(
                                    'form' => $entity
                                )
                            )
                            , 'text/html'
                        );

                    $this->get('mailer')->send($swift);

                }

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
            'timer' => $timer,
            'map' => $map
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

    public function rememberAction() {

        // Функция рассылки напоминаний
        function sendRemember($controller, $container, $day, $week = '') {

            $count = 0;

            $em = $controller->getDoctrine()->getManager();;
            $repository = $controller->getDoctrine()->getRepository('SiteMainBundle:Client');

            $clients = $repository->findBy(array(
                'flagRemember' . $week => false,
                'registerDate' => $day == '14' ? false : true
            ));

            foreach($clients as $client) {
                if ($count > 20) {

                    break;

                }

                $swift = \Swift_Message::newInstance()
                    ->setSubject('Ракурс')
                    ->setFrom(array($container->getParameter('email_from') => "Ракурс"))
                    ->setTo($client->getEmail())
                    ->setBody(
                        $controller->renderView(
                            'SiteMainBundle:Frontend/Email:remember' . $day . '.html.twig'
                        )
                        , 'text/html'
                    );

                $controller->get('mailer')->send($swift);

                if ($week == '2') {
                    $client->setFlagRemember2(true);
                } else {
                    $client->setFlagRemember(true);
                }

                $em->flush();

                $count++;
            }

        }

        // Получение дат старта событий из настроек
        $repository_settings = $this->getDoctrine()->getRepository('SiteMainBundle:Settings');

        $timer14 = $repository_settings->findOneByKey('timer14')->getValue();
        $timer15 = $repository_settings->findOneByKey('timer15')->getValue();

        $date14 = new \DateTime($timer14);
        $date15 = new \DateTime($timer15);

        $now = new \DateTime();

        $interval14 = $now->diff($date14)->format('%a');
        $interval15 = $now->diff($date15)->format('%a');

        if (intval($interval14) == 14) {
            sendRemember($this, $this->container, '14', '2');
        }

        if (intval($interval14) == 7) {
            sendRemember($this, $this->container, '14');
        }

        if (intval($interval15) == 14) {
            sendRemember($this, $this->container, '15', '2');
        }

        if (intval($interval15) == 7) {
            sendRemember($this, $this->container, '15');
        }

        return new Response('OK');

    }
}
