<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestFormController extends Controller
{
    
    /**
     * @Route("/do")
     */
public function newAction(Request $request)
{
    $task = new Task();
    $form = $this->createForm(TaskType::class, $task);
    
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid())
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
        
    }
    
    return $this->render('default/new.html.twig', array(
      'form' => $form->createView(),
    ));
}

}
