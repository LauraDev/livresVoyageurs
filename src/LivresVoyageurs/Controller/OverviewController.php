<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\HttpFoundation\Request;

class  OverviewController
{

    //Display Overview Pages

    # BookList
    public function bookListAction(Application $app) {

        # Books registered as available
        $bookList = $app['idiorm.db']->for_table('view_books')
        ->where('disponibility_book', 1)
        ->find_result_set();

        return $app['twig']->render('overview/bookList.html.twig', [
            'bookList'     => $bookList
        ]);
    }


    # Capture         
    public function newCaptureAction(Application $app, Request $request) {

        $formCapture = $app['form.factory']->createBuilder(FormType::class)
        
            # Form Fields
            ->add('id_book', TextType::class, [                
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control'
                ]
            ])
            ->add('address', TextType::class, [                
                'required'      =>  true,
                'label'         =>  false,
                'attr' => [
                    'class'    => 'form-control'
                ]
            ])
            ->add('city_pointer', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('lat_pointer', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('lng_pointer', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('comment_capture', TextareaType::class, [
                'required'      =>  false,
                'label'         =>  false,
                'attr'          =>  [
                    'class'     => 'form-control'
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

            ->getForm();
        # Handle Post Data
        $formCapture->handleRequest($request);

        // Check if form is valid
        if ($formCapture->isValid()) :
            
            # Capture = FormCapture data
            $capture = $formCapture->getData();

            # Connect to DB : Register a new pointer
            $pointerDb = $app['idiorm.db']->for_table('pointers')->create();
            $pointerDb->id_book           = $capture['id_book'];
            $pointerDb->lat_pointer       = $capture['lat_pointer'];
            $pointerDb->lng_pointer       = $capture['lng_pointer'];
            $pointerDb->city_pointer      = $capture['city_pointer'];
            $pointerDb->save();

            # Get last inserted Id
            $pointerId = $pointerDb->id();

            #  Connect to DB : Register the capture's member and comment
            $captureDb = $app['idiorm.db']->for_table('captures')->create();
            $captureDb->id_pointer           = $pointerId;
            $captureDb->comment_capture      = $capture['comment_capture'];
            $captureDb->save();
            
            # Connect to DB : Set the book as unavailable
            $bookDb =  $app['idiorm.db']->for_table('books')->find_one($capture['id_book']);
            $bookDb->disponibility_book      = 0;
            $bookDb->save();

            # Redirection
            return $app->redirect('?capture=success');

        endif;
        
        return $app['twig']->render('overview/newCapture.html.twig', [
            'formCapture'      => $formCapture->createView(),
        ]);
    }



    # Search
    public function searchAction(Application $app) {
        
        return $app['twig']->render('overview/search.html.twig', []);
    }




    # Contact
    public function contactAction(Application $app, Request $request)
    {
        $form = $app['form.factory']->createBuilder(FormType::class)

            ->add('name', TextType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control',
                ]
            ])
            ->add('mail', EmailType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control',
                ]
            ])
		    ->add('message', TextType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control',
                ]
            ])
		    ->getForm();

            $form->handleRequest($request);

			if ($form->isValid())
			{
				$data = $form->getData();
				# Create the Transport
                $transport = (new Swift_SmtpTransport('smtp.orange.fr', 465, 'ssl'))
                ->setUsername('livresvoyageurs@orange.fr')
                ->setPassword('lola2017');

                # Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

                # Load template
                $template = $app['twig']->loadTemplate('contact.html.twig');

                # Parameters for renderBlock
                $parameters = array('name'    => $data['name'],
                                    'message' => $data['message'],
                                    'mail'    => $data['mail']
                                );

                # Create a message
                $message = (new Swift_Message())
                    ->setFrom($data['mail'])
                    ->setTo('livresvoyageurs@orange.fr')
                    ->setSubject($template->renderBlock('subject', $parameters))
                    ->setBody($template   ->renderBlock('body_text', $parameters), 'text/plain')
                    // ->addPart($template    ->renderBlock())
                    ;

                # Send the message
                $result = $mailer->send($message);

                return $app['twig']->render('overview/contact.html.twig', array(
                    'form'  => $form->createView(),
                    'sendMessage' => true
                ));
            }

		return $app['twig']->render('overview/contact.html.twig', array(
			'form'  => $form->createView(),
		));
    }
    


}