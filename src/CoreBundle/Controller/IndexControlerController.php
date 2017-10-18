<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexControlerController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
//        return $this->render('CoreBundle:IndexControler:index.html.twig', array(
//            // ...
//        ));
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('ModelBundle:Post')->findAllInOrder();

        return [
            'posts' => $posts,
        ];
    }

    /**
     * @Route("/show/{id}")
     * @Template()
     */
    public function showAction($id)
    {
//        return $this->render('CoreBundle:IndexControler:show.html.twig', array(
//            // ...
//        ));

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ModelBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('O post não existe! Volte para home!');
        }

        return [
            'post' => $post,
        ];
    }

}
