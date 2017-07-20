<?php

// src/AppBundle/Controller/RegistrationController.php
namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();



            $name = $user->getUsername();

            $email = $user->getEmail();

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('symfony@blog.com')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                        'emails/register.html.twig',
                        array('name' => $name)
                    ),
                    'text/html'
                )
            ;

            $this->get('mailer')->send($message);
            echo 'Registeration Successful!';

        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}