<?php

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Acme\HelloBundle\Entity\FormFields;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyNewBundle:Default:index.html.twig');
    }
    public function userFormAction()
    {
        $formFields = new FormFields();
        $formFields->setName('');
        $formFields->setEmail('');
        $formFields->setGender('male');
        $formFields->setCountry('RU');

        $form = $this->createFormBuilder($formFields)
            ->add('name', 'text')
            ->add('email', 'text')
	        ->add('country','country')
            ->add('gender', 'choice', array(
            'choices' => array('male' => 'мужской', 'female' => 'женский')))            
            ->getForm();

        return $this->render('MyNewBundle:Default:userform.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function userFormSendAction(Request $request)
    {
	    $formFields = new FormFields();
	    $form = $this->createFormBuilder($formFields)
	        ->add('email', 'text')
	        ->add('name', 'text')
	        ->add('country','country')
            ->add('gender', 'choice', array(
            'choices' => array('male' => 'мужской', 'female' => 'женский'),
            'preferred_choices' => array('male')))            
	        ->getForm();

	    if ($request->getMethod() == 'POST') {
	        $form->bind($request);
        $fields = 'Email = ' .$formFields -> getEmail() .PHP_EOL
                 .'name = ' .$formFields -> getName() .PHP_EOL
                 .'country = ' .$formFields -> getCountry() .PHP_EOL
                 .'gender = ' .$formFields -> getGender();
	    $mailer = $this->get('mailer');

	    $message = \Swift_Message::newInstance()
	        ->setSubject('Приветственное сообщение')
	        ->setFrom('ribakov_da@mail.ru')
	        ->setTo($formFields->getEmail())
	        ->setBody($this->renderView('MyNewBundle:mail:mail_message.html.twig', array('fields' => $fields)))
	    ;
	    $mailer->send($message);	           	       
	    }
	    return $this->render('MyNewBundle:Default:succeed.html.twig');
    }
    public function succeedAction(Request $request)
    {
		return $this->render('MyNewBundle:Default:succeed.html.twig');
	}
}
