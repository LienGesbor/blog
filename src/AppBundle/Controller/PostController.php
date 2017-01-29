<?php

namespace AppBundle\Controller;

use AppBundle\Form\PostType;
use AppBundle\Entity\Post;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



/**
 * @Route("posts")
 */
class PostController extends Controller
{
    
    
    /**
     * @Route("/", name="list_posts")
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
     * @Route("/create", name="create_post")
     */
    public function createAction(Request $request)
    {
        $post = new Post();
        
        $form = $this->createForm(PostType::class, $post);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Create Post'
        ));
        
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
     * @Route("/{id}", name="show_post")
     */
    public function showAction(Post $post)
    {
        
        return $this->render('postforms/show.html.twig', array(
           'post' => $post
        ));
    }
}