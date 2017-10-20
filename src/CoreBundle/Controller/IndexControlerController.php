<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request; // para pegar o número de páginas, de acordo com a quantidade de
                                        // posts temos que usar o request do symfony

class IndexControlerController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
//        return $this->render('CoreBundle:IndexControler:index.html.twig', array(
//            // ...
//        ));
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('ModelBundle:Post')->findAllInOrder();

//        return [
//            'posts' => $posts,
//        ];

        /*
             Em nossa indexAction temos que pegar a biblioteca do paginador, passar nosso posts, pegar as
        páginas via request, e quantidade de posts que queremos por páginas, e retorná- los em forma de array
        para que nossa view possa apresentar. Em meu caso vou usar apenas três posts por página
        */

        /** @var  $paginator */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($posts, $request->query->get('page', 1), 3);

        return [
            'pagination' => $pagination,
        ];

    }

    /**
     * @Route("/show/{slug}", name="show") //trocamos de 'id' para 'slug'
     * @Template()
     */
    public function showAction($slug) //trocamos de '$id' para '$slug'
    {
//        return $this->render('CoreBundle:IndexControler:show.html.twig', array(
//            // ...
//        ));

        $em = $this->getDoctrine()->getManager();

        //$post = $em->getRepository('ModelBundle:Post')->find($id);  //=> neste método estamos passando para a
                        // variável $post, o método find, e recuperando o id. Vamos substituir o find para
                                                                //findOneBy e passar um array de slug. Vejamos abaixo:
        $post = $em->getRepository('ModelBundle:Post')->findOneBy(['slug' => $slug ]);

        if (!$post) {
            throw $this->createNotFoundException('O post não existe! Volte para home!');
        }

        return [
            'post' => $post,
        ];
    }

}
