<?php

namespace FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/home",name="homefrontend")
     */
    public function indexAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();



        return $this->render(':Frontend/views/home:index.html.twig', array(


        ));
    }

    /**
     *
     *
     * @Route("getliststadt", name="getliststadt",options={"expose"=true})
     * @Method({"GET", "POST"})
     */
    public function getstadt(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $fitness = $em->getRepository('BackendBundle:Fitness')->findAll();
        $all=array();

        foreach ($fitness as $stadt) {
            $stadtname = $stadt->getStadt();
            if (!in_array($stadtname, $all)) {
                $all[] = $stadtname;
            }
        }

        $serializer = $this->get('fos_js_routing.serializer');
        $array = $serializer->normalize($all);
        return new  JsonResponse($array);


    }

    /**
     * @Route("/SearchAction",name="SearchAction")
     */
    public function SearchAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $stadt = $request->get('typestadt');
        $min = $request->get('minPreis');
        $max = $request->get('maxPreis');
        $trainer = $request->get('trainer');

        $studenden = $request->get('stunden');
        $bewertung = $em->getRepository('BackendBundle:Bewertung')->findAll();


        if($min == ""){
            $min=0;
        }
        if($max== ""){
            $max=0b11111111;
        }



            $result = $em->getRepository("BackendBundle:Fitness")->createQueryBuilder('F')
                ->where('F.stadt LIKE :stadt')
                ->andWhere('F.trainer Like :trainer')
                ->andWhere('F.offnenZeit Like :offnenzeit')
                ->andWhere('F.preis BETWEEN :min AND :max')
                ->setParameter('stadt', $stadt)
                ->setParameter('trainer', $trainer)
                ->setParameter('offnenzeit', $studenden)
                ->setParameter('min', $min)
                ->setParameter('max', $max)
                ->addOrderBy('F.preis', 'ASC')
                ->getQuery()
                ->getResult();
        if(!empty($result)){
            return $this->render(':Frontend/views/home:list.html.twig', array(

                'best'=>$result,
                'bewertungs'=>$bewertung,


            ));
        }else{
            $result = $em->getRepository("BackendBundle:Fitness")->createQueryBuilder('F')
                ->where('F.stadt LIKE :stadt')
                ->setParameter('stadt', $stadt)
                ->addOrderBy('F.preis', 'ASC')
                ->getQuery()
                ->getResult();


            return $this->render(':Frontend/views/home:list.html.twig', array(

                'result'=>$result,
                'bewertungs'=>$bewertung,


            ));
        }








    }
}
