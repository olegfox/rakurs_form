<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function indexAction($slug)
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Page');

        $page = $repository->findOneBySlug($slug);
        $buklet = $repository->findOneBySlug('bukliet-uchastnika');

        if (!$page)
        {

            throw $this->createNotFoundException($this->get('translator')->trans('Страница не найдена'));

        }

        $params = array(
            "page" => $page,
            "buklet" => $buklet
        );
        
        if (in_array($slug, array("prozhivaniie", "transfier", "sviazat-sia-s-koordinatorom"))) {

            $params = array_merge($params, array(
                'withoutMenu' => true
            ));

        }

        return $this->render('SiteMainBundle:Frontend/Page:index.html.twig', $params);
    }
}
