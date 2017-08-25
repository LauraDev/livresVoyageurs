<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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





        // Add a book
        
        



        //  Capture 
        $formCapture = $app['form.factory']->createBuilder(FormType::class)
        
            # use Symfony\Component\Form\Extension\Core\Type\TextType;
            # use Symfony\Component\Validator\Constraints\NotBlank;
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
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'loc_autocomplete'
                ]
            ])

            ->add('comment_capture', TextareaType::class, [
                
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control',
                    'placeholder' => 'Où j\'ai trouvé ce livre? est-il en bon état? ...'
                ]
            ])
                                
            ->add('submit', SubmitType::class, ['label' => 'Publier'])

            ->getForm();

        # Update DB
        $formCapture->handleRequest($request);

        if ($formCapture->isValid()) :
            
            # Capture = FormCapture data
            $capture = $formCapture->getData();

            #Get address from Google autocomplete, save into a var: lat, lng, city
            $lat = '';
            $lng = '';
            $city = '';

            # Connect to DB : Register a new pointer
            $pointerDb = $app['idiorm.db']->for_table('pointers')->create();
            $pointerDb->id_book           = $capture['id_book'];
            $pointerDb->lat_pointer       = $lat;
            $pointerDb->lng_pointer       = $lng;
            $pointerDb->city_pointer      = $city;
            $memberDb->save();

            # Get last inserted Id
            // $pointerId = $memberDb->id(); #id_pointer


            #  Connect to DB : Register the capture member and comment
            $captureDb = $app['idiorm.db']->for_table('captures')->create();
            $captureDb->id_pointer           = $pointerId;
            $captureDb->id_member            = $app['user']->getId_member();
            $captureDb->comment_capture      = $capture['comment_capture'];

            # Redirection
            return $app->redirect('?capture=success');

        endif;
        
        




        // Update Account
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

        # Update DB
        $formAccount->handleRequest($request);

        if ($formAccount->isValid()) :

            # Connect to DB : Register a new member
            $member = $formAccount->getData();

            $memberDb = $app['idiorm.db']->for_table('members')->find_one($app['user']->getId_member());
            $memberDb->pseudo_member        = $member['pseudo_member'];
            $memberDb->mail_member          = $member['mail_member'];
            $memberDb->pass_member          = $app['security.encoder.digest']->encodePassword($member['pass_member'], '');
            $memberDb->avatar_member        = $member['avatar_member'];
            $memberDb->role_member          = $member['role_member'];
            $memberDb->save();

            # Redirection
            return $app->redirect('?account=success');

        endif;



        

        # Books registered by the user
        $bookList = $app['idiorm.db']->for_table('view_books')
                                        ->where('id_member', $app['user']->getId_member())
                                        ->find_result_set();	

            
        # user's pending friends
        $pendingList = $app['idiorm.db']->for_table('view_friends')
                                        ->where_any_is(array(
                                                array('id_member_1'  =>  $id_member, 'status_friend' => 0 ),
                                                array('id_member_2'  =>  $id_member, 'status_friend' => 0 )
                                        ))
                                        ->where_not_equal('action_friend', $id_member)
                                        ->order_by_desc('date_friend')
                                        ->find_result_set();
        # user's friends
        $friendList = $app['idiorm.db']->for_table('view_friends')
                                        ->where_any_is(array(
                                                array('id_member_1'  =>  $id_member, 'status_friend' => 1 ),
                                                array('id_member_2'  =>  $id_member, 'status_friend' => 1 )
                                        ))
                                        ->where_not_equal('action_friend', $id_member)
                                        ->order_by_desc('date_friend')
                                        ->find_result_set();

        return $app['twig']->render('member/espacePerso.html.twig', [
            'pseudo'        => $pseudo,
            'formAccount'   => $formAccount->createView(),
            'formCapture'   => $formCapture->createView(),
            'bookList'      => $bookList,
            'pendingList'   => $pendingList,
            'friendList'    => $friendList
        ]);
    }

}