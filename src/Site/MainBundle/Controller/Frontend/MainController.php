<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:TypeTraining');

        $typeTrainings = json_decode($repository->findAllJson());

        $params = array(
            "typeTrainings" => $typeTrainings
        );

        return $this->render('SiteMainBundle:Frontend/Main:index.html.twig', $params);
    }

    public function jsonAction(Request $request)
    {
        $typeTraining = $request->get("typeTraining");

        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Training');

        if(!is_null($typeTraining)) {
            $calendar = $repository->findAllJson($typeTraining);
        } else {
            $calendar = $repository->findAllJson();
        }

        return new JsonResponse($calendar);
    }

    public function jsonCouchsAction() {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Couch');

        $couchs = $repository->findAllJson();

        return new JsonResponse($couchs);
    }

    public function jsonGroupsAction() {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Grup');

        $groups = $repository->findAllJson();

        return new JsonResponse($groups);
    }

    public function jsonTypeTrainingAction() {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:TypeTraining');

        $typeTraining = $repository->findAllJson();

        return new JsonResponse($typeTraining);
    }
}
