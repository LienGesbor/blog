<?php

namespace AppBundle\Controller;

use AppBundle\Form\PostType;
use AppBundle\Entity\Post;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PostController extends Controller
{
    
    
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $results = $em->getRepository('AppBundle:Post')->findAll();
        

        return $this->render('postforms/list.html.twig', array(
            'results' => $results,
        ));
    }
    
    
    /**
     * @Route("/post/create", name="create_post")
     */
    public function createAction(Request $request)
    {
        $post = new Post();
        
        $form = $this->createForm(PostType::class, $post);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $post = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            
        }
        
        return $this->render('postforms/create.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Route("/post/{id}", name="show_post")
     */
    public function showAction(Post $post)
    {
        
        return $this->render('postforms/show.html.twig', array(
           'post' => $post
        ));
    }
}