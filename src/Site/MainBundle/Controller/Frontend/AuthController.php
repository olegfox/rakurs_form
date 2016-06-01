<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Site\MainBundle\Entity\Client;
use Site\MainBundle\Form\ClientType;

class AuthController extends Controller
{
    public function registration14Action()
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Page');

        $page = $repository->findOneBySlug('rieghistratsiia14');

        $entity = new Client();
        $form   = $this->createCreateForm($entity);

        $form->add('submit', 'submit', array(
            'label' => 'регистрация',
            'attr' => array(
                'class' => 'btn btn-default btn-lg'         
            )
        ));
        $form->remove('friends');

        return $this->render('SiteMainBundle:Frontend/Main:registration14.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'page' => $page
        ));
    }

    public function registration15Action()
    {
        $entity = new Client();
        $form   = $this->createCreateForm($entity);

        $form->remove('transport');
        $form->remove('time');

        return $this->render('SiteMainBundle:Frontend/Main:registration15.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    private function createCreateForm(Client $entity)
    {
        $form = $this->createForm(new ClientType(), $entity, array(
            'action' => $this->generateUrl('frontend_client_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.create'));

        return $form;
    }
}
