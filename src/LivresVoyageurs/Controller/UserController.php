<?php

namespace LivresVoyageurs\Controller;

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

            # use Symfony\Component\Form\Extension\Core\Type\TextType;
            # use Symfony\Component\Validator\Constraints\NotBlank;
            ->add('pseudo_member', TextType::class, [

                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'         => 'form-control',
                ]
            ])
            ->add('mail_member', EmailType::class, [

                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'         => 'form-control',
                ]
            ])
            ->add('pass_member', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
                'attr' => [
                    'class' => 'form-control'
                    ]
            ))
            ->add('role_member', HiddenType::class, [
                'attr' => [
                    'value' => 'role_member'
                ]
            ])
            ->add('avatar_member', FileType::class, [

                'required'      =>  false,
                'label'         =>  false,
                'attr'          =>  [
                    'class'         => 'dropify'
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Publier'])

            ->getForm();

        # Traitement des données POST
        # use Symfony\Component\HttpFoundation\Request;
        $form->handleRequest($request);

        if ($form->isValid()) :
            //Inscription

    # Connect to DB : Register a new member



            $member = $form->getData();
            $memberDb = $app['idiorm.db']->for_table('members')->create();
            $memberDb->pseudo_member        = $member['pseudo_member'];
            $memberDb->mail_member          = $member['mail_member'];
            $memberDb->pass_member          = $member['pass_member']->encodePassword($request->get('pass_member'), '');
            $memberDb->avatar_member        = $member['avatar_member'];
            $memberDb->role_member          = $member['role_member'];
            $memberDb->save();

            # Redirection
            return $app->redirect( $app['url_generator']->generate('livresVoyageurs_connexion'));

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
    public function contactAction(Application $app)
    {
        return $app['twig']->render('user/contact.html.twig');
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
    public function resetPasswordAction(Application $app)
    {
        return $app['twig']->render('user/resetPassword.html.twig');
    }
}
