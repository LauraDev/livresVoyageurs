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

class  MemberController
{

    //Display Chat Page
    public function chatAction(Application $app, $receiver) {

        # Define messages sender
        // $sender = $app['pseudo']; 
$sender = 'Loic';
        
        return $app['twig']->render('member/chat.html.twig', [
            'receiver' => $receiver,
            'sender'   => $sender
        ]);
    }


    //Display Personal Space
    public function espacePersoAction(Application $app, Request $request, $pseudo) {
        

        //Create form
        $formAccount = $app['form.factory']->createBuilder(FormType::class)
        
                    # use Symfony\Component\Form\Extension\Core\Type\TextType;
                    # use Symfony\Component\Validator\Constraints\NotBlank;
                    ->add('pseudo_member', TextType::class, [
        
                        'required'      =>  true,
                        'label'         =>  false,
                        'constraints'   =>  array(new NotBlank()),
                        'attr'          =>  [
                            'class'     => 'form-control',
                            'value'     => $app['user']->getUsername()
                        ]
                    ])
                    ->add('mail_member', EmailType::class, [
        
                        'required'      =>  true,
                        'label'         =>  false,
                        'constraints'   =>  array(new NotBlank()),
                        'attr'          =>  [
                            'class'     => 'form-control',
                            'value'     => $app['user']->getMail_member()
                        ]
                    ])
                    ->add('pass_member', RepeatedType::class, array(
                        'type' => PasswordType::class,
                        'first_options'  => array('label' => 'Password'),
                        'second_options' => array('label' => 'Repeat Password'),
                        'attr' => [
                            'class'      => 'form-control',
                            'value'     => $app['user']->getPass_member()
                            ]
                    ))
                    ->add('role_member', HiddenType::class, [
                        'attr' => [
                            'value' => 'ROLE_MEMBER',
                            'value'     => $app['user']->getPass_member()
                        ]
                    ])
                    ->add('avatar_member', FileType::class, [
        
                        'required'      =>  false,
                        'label'         =>  false,
                        'attr'          =>  [
                            'class'     => 'dropify'
                        ]
                    ])
                    ->add('submit', SubmitType::class, ['label' => 'Publier'])
        
                    ->getForm();
        
                # Traitement des données POST
                # use Symfony\Component\HttpFoundation\Request;
                $formAccount->handleRequest($request);
        
                if ($formAccount->isValid()) :
        
                    # Connect to DB : Register a new member
                    $member = $formAccount->getData();
                    $memberDb = $app['idiorm.db']->for_table('members')->create();
                    $memberDb->pseudo_member        = $member['pseudo_member'];
                    $memberDb->mail_member          = $member['mail_member'];
                    $memberDb->pass_member          = $app['security.encoder.digest']->encodePassword($member['pass_member'], '');
                    $memberDb->avatar_member        = $member['avatar_member'];
                    $memberDb->role_member          = $member['role_member'];
                    $memberDb->save();
        
                    # Redirection
                    return $app->redirect('espace?account=success');
        
                endif;

        return $app['twig']->render('member/espacePerso.html.twig', [
            'pseudo' => $pseudo,
            'formAccount'=> $formAccount->createView()
        ]);
    }

}