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
     * @Route("/")
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
     * @Route("/{id}", name="show_post")
     */
    public function showAction(Post $post)
    {
        $deleteForm = $this->render('postforms/list.html.twig', array(
        ));
    }
    
    /**
     * @Route("/create")
     */
    public function createAction(Request $request)
    {
        
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
    
    /**
     * @Route("/postnumber{id}/edit_post", name="edit_post")
     */
    public function editAction(Request $request)
    {
        $post = new post();
        
        var_dump($_GET);
        
        $editForm = $this->createForm(PostType::class, $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $id = $request->get('id');
            
            $stmt = 'UPDATE posts WHERE';
        }
        return $this->render('postforms/edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }
}
    
    
            

