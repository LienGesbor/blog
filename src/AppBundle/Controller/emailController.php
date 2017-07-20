<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class emailController extends Controller
{

    /**
     * @Route ("/email", name="email_test")
     */
    public function indexAction()
    {

        $name = 'Daniel';
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('symfony@blog.com')
            ->setTo('liengesbor@gmail.com')
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'emails/register.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;

        $this->get('mailer')->send($message);

        return $this->render('emails/emailTest.html');
    }


}