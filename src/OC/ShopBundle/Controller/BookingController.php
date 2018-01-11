<?php

// src/OC/PlatformBundle/Controller/ticketController.php

namespace OC\ShopBundle\Controller;



use OC\ShopBundle\Entity\Ticket;
use OC\ShopBundle\Entity\Booking;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class BookingController extends Controller
{
    
	public function visitorFormAction(Request $request)
	{

    $booking = new Booking();
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $booking);
    $formBuilder
      ->add('firstName',    TextType::class)
      ->add('lastName',    TextType::class)
      ->add('email',    EmailType::class)
      ->add('type', CheckboxType::class, array(
                'label'         => 'Day ',
                'required'      => false,))
      ->add('save',      SubmitType::class)
          ;
    $form = $formBuilder->getForm();
    return $this->render('OCShopBundle:Form:visitorForm.html.twig', array(
      'formu' => $form->createView(),
    ));      
	}

//ici    public function userForm()
  
    public function addAction()
    {
        $content = $this->get('templating')
        				->render('OCShopBundle:Booking:index.html.twig', array('nom' => 'lo faro', 'prenom' => 'juliette', 'age' => 12));
        				
    	return new Response($content);
    }
}