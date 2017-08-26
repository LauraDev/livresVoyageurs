<?php

namespace LivresVoyageurs\Controller;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Silex\Application;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\Request;
use Twig\Token;


class UserController
{

    //Display Home page
    public function indexAction(Application $app)
    {
        return $app['twig']->render('user/index.html.twig');
    }





    //Display Inscription page
    public function inscriptionAction(Application $app, Request $request)
    {
        //Create form
        $form = $app['form.factory']->createBuilder(FormType::class)
        
            ->add('pseudo_member', TextType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control',
                ]
            ])
            ->add('mail_member', EmailType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control',
                ]
            ])
            ->add('pass_member', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array(
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Entrez votre mot de passe',
                        'class'      => 'form-control'
                    ]
                ),
                'second_options' => array(
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Confirmez votre mot de passe',
                        'class'      => 'form-control'
                    ]
                ),
                'attr' => [
                    'class'      => 'form-control'
                    ]
            ))
            ->add('role_member', HiddenType::class, [
                'attr' => [
                    'value' => 'ROLE_MEMBER'
                ]
            ])
            ->add('avatar_member', FileType::class, [
                'required'      =>  false,
                'label'         =>  false,
                'attr'          =>  [
                    'class'     => 'form-control dropify'
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Publier'])

            ->getForm();

        # POST: handle data
        $form->handleRequest($request);

        if ($form->isValid()) :

            # Connect to DB : Register a new member
            $member = $form->getData();
            $memberDb = $app['idiorm.db']->for_table('members')->create();
            $memberDb->pseudo_member        = $member['pseudo_member'];
            $memberDb->mail_member          = $member['mail_member'];
            $memberDb->pass_member          = $app['security.encoder.digest']->encodePassword($member['pass_member'], '');
            $memberDb->avatar_member        = $member['avatar_member'];
            $memberDb->role_member          = $member['role_member'];
            $memberDb->save();

            # Redirection
            return $app->redirect('connexion?inscription=success');

        endif;

        return $app['twig']->render('user/inscription.html.twig', ['form'=>$form->createView()]);
    }









    //Display Connexion page
    public function connexionAction(Application $app, Request $request)
    {
        return $app['twig']->render('user/connexion.html.twig', [
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username')
        ]);
    }







    // Display mentions page
    public function mentionsAction(Application $app)
    {
        return $app['twig']->render('user/mentions.html.twig');
    }







    // Contact
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
				// Create the Transport
                $transport = (new Swift_SmtpTransport('smtp.orange.fr', 465, 'ssl'))
                ->setUsername('lgallay@orange.fr')
                ->setPassword('luciol16');

                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

                // Create a message
                $message = (new Swift_Message('TestContact'))
                    ->setFrom('lgallay@orange.fr')
                    ->setTo('lgallay@orange.fr')
                    ->setBody($data['name'].$data['mail'].$data['message'])
                    ;

                // Send the message
                $result = $mailer->send($message);

                return $app['twig']->render('user/contact.html.twig', array(
                    'form'  => $form->createView(),
                    'sendMessage' => true
                ));
            }

		return $app['twig']->render('user/contact.html.twig', array(
			'form'  => $form->createView(),
		));
	}









    //Display the menu
    public function menu(Application $app, $active_page)
    {
        return $app['twig']->render('menu.html.twig', [
            'active_page' => $active_page ]);
    }








    //Disconnection
    public function deconnexionAction(Application $app)
    {
        # Empty Session
        $app['session']->clear();
        # Redirect to Home
        return $app->redirect($app['url_generator']->generate('livresVoyageurs_home'));
    }







    
    //Reset Password
    public function resetPasswordAction(Application $app, Request $request)
    {
        $form = $app['form.factory']->createBuilder(FormType::class)

        //create an email input type
        ->add('mail_member', EmailType::class, [
            'required'      =>  true,
            'label'         =>  false,
            'constraints'   =>  array(new NotBlank()),
            'attr'          =>  [
                'class'     => 'form-control',
            ]
        ])
        //create a submit
        ->add('submit', SubmitType::class, ['label' => 'Envoyer'])

        ->getForm();

        $form->handleRequest($request);


        $mail = $form->getData();

        if ($form->isValid()) {
            //check if email exist
            $checkMail = $app['idiorm.db']->for_table('members')
                                            ->where('mail_member', $mail['mail_member'])
                                            ->count();
            if ($checkMail) {

                // Create the Transport
                $transport = (new Swift_SmtpTransport('smtp.orange.fr', 465, 'ssl'))
                ->setUsername('lgallay@orange.fr')
                ->setPassword('luciol16');

                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

                $template = $app['twig']->loadTemplate('resetPasswordMail.html.twig');
                // generate token
                $token = md5($mail['mail_member'] . date('YmdHis'));
                $tokenDb = $app['idiorm.db']->for_table('members')->where('mail_member', $mail['mail_member'])->find_one();
                $tokenDb->token_member = $token;
                $tokenDb->save();
                // Url for password change
                $urlReset = 'http://' . $_SERVER['SERVER_NAME'] . '/livresVoyageurs/public/mdpReset/'.$token;
                // Array for renderBlock
                $parameters  = [];

                // Create a message
                $message = (new Swift_Message('Test'))
                            ->setFrom('lgallay@orange.fr')
                            ->setTo($mail['mail_member'])
                            ->setSubject($template ->renderBlock('subject', $parameters))
                            ->setBody($template    ->renderBlock('body_text', $parameters),'text/plain')
                            ->addPart($template    ->renderBlock('body_html', array('url' => $urlReset)),'text/html');


                // Send the message
                $result = $mailer->send($message);
                if($result) {
                    $reset = 'ok';
                    return $app['twig']->render('user/resetPassword.html.twig',  [
                        'form'=>$form->createView(),
                        'reset' => $reset
                    ]);
                } // Result

            } // CheckMail

        } // Form valid
        
        return $app['twig']->render('user/resetPassword.html.twig',  ['form'=>$form->createView()]);
    }





    //Display Teset password page 2
    public function resetPassword2Action(Application $app, Request $request, $token)
    {
        //Create form
        $form = $app['form.factory']->createBuilder(FormType::class)

            ->add('mail_member', EmailType::class, [

                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control',
                ]
            ])
            ->add('pass_member', RepeatedType::class, array(
                'type'          => PasswordType::class,
                'first_options' => array(
                    'label' => false,
                    'attr'  => [
                        'class'       => 'form-control',
                        'placeholder' => 'Entrez votre mot de passe'
                        ]
                ),
                'second_options' => array(
                    'label' => false,
                    'attr'  => [
                        'class'       => 'form-control',
                        'placeholder' => 'Confirmer votre mot de passe'
                        ]
                ),
                'attr' => [
                    'class'      => 'form-control'
                    ]
            ))
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

            ->getForm();

        # Handle Post Data
        $form->handleRequest($request);

        if ($form->isValid()) :
            # Connect to DB : Register a new member
            $member = $form->getData();

            # Get mail_member from DB depending on Token
            $mail = $app['idiorm.db']->for_table('members')
                                    ->where('token_member', $token)
                                    ->find_one();
            # Compare address mail in Db and from form data
            if($mail['mail_member'] == $member['mail_member'])
            {
                $memberDb = $app['idiorm.db']->for_table('members')->find_one($mail['id_member']);
                $memberDb->token_member = "";
                $memberDb->pass_member          = $app['security.encoder.digest']->encodePassword($member['pass_member'], '');
                $memberDb->save();

                # Redirection
                return $app->redirect( $app['url_generator']->generate('livresVoyageurs_connexion') );
            }

        endif;

        return $app['twig']->render('user/resetPassword2.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
