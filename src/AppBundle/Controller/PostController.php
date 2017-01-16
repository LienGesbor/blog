<?php

namespace AppBundle\Controller;

use AppBundle\Form\PostType;
use AppBundle\Entity\Post;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PostController extends Controller
{
    
    
    /**
     * @Route("/posts")
     */
    public function indexAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();

        $results = $em->getRepository('AppBundle:Post')->findAll();

        return $this->render('postforms/list.html.twig', array(
            'results' => $results,
        ));
    }
    
    /**
     * @Route("/posts/create")
     */
    public function createAction(Request $request) {
        
        $post = new Post();
        
        $form = $this->createForm(PostType::class, $post, array(
            'method'=> 'POST'
        ));
        
        
        $form->add('Submit', SubmitType::class);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($post);
            $em->flush();
        }
        return $this->render('postforms/create.html.twig', array(
            'form' => $form->createView(),
        ));
        
    }
            
}
