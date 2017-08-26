<?php

namespace LivresVoyageurs\Controller;

use LivresVoyageurs\Traits\Shortcut;
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

    use Shortcut;
    
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


        # Get member infos

        # 1 : Get current member infos
        $currentMember = $app['idiorm.db']->for_table('members')
        ->find_one($app['user']->getId_member());	



        # 2: Add a book
        $formAddBook = $app['form.factory']->createBuilder(FormType::class)
        
            # Form Fields
            ->add('id_member', HiddenType::class, [
                'required'      =>  true,
                'attr'          => [
                    'value'     => $currentMember['id_member']
                ]
            ])
            ->add('id_author', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('id_category', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('title_book', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('summary_book', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('language_book', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('ISBN_book', TextType::class, [                
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control'
                ]
            ])
            ->add('photo_book', FileType::class, [                
                'required'      =>  false,
                'label'         =>  false,
                'attr'          =>  [
                    'class'     => 'form-control dropify'
                ]
            ])
            # LIVRE DISPO POUR LA COMMUNAUTE
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

            ->getForm();
        
        



        #3 : Capture         
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
        # Update DB
        $formCapture->handleRequest($request);


        if ($formCapture->isValid()) :
            
            # Capture = FormCapture data
            $capture = $formCapture->getData();

            #Get address from Google autocomplete, save into a var: lat, lng, city
            // $lat = '';
            // $lng = '';
            // $city = '';

            # Connect to DB : Register a new pointer
            $pointerDb = $app['idiorm.db']->for_table('pointers')->create();
            $pointerDb->id_book           = $capture['id_book'];
            $pointerDb->lat_pointer       = $capture['lat_pointer'];
            $pointerDb->lng_pointer       = $capture['lng_pointer'];
            $pointerDb->city_pointer      = $capture['city_pointer']; //$city;
            $pointerDb->save();

            # Get last inserted Id
            $pointerId = $pointerDb->id();

            #  Connect to DB : Register the capture member and comment
            $captureDb = $app['idiorm.db']->for_table('captures')->create();
            $captureDb->id_pointer           = $pointerId;
            $captureDb->id_member            = $currentMember['id_member'];
            $captureDb->comment_capture      = $capture['comment_capture'];
            $captureDb->save();

            # Redirection
            return $app->redirect('?capture=success');

        endif;
        
        




        # 4-a : Update Account Infos
        $formAccount = $app['form.factory']->createBuilder(FormType::class)
        
            # Form Fields
            ->add('pseudo_member', TextType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control',
                    'value'     => $currentMember['pseudo_member']
                ]
            ])
            ->add('mail_member', EmailType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank()),
                'attr'          =>  [
                    'class'     => 'form-control',
                    'value'     => $currentMember['mail_member']
                ]
            ])
            ->add('avatar_member', FileType::class, [
                'required'      =>  false,
                'label'         =>  false,
                'attr'          =>  [
                    'class'     => 'form-control dropify',
                    'data-default-file'            => '/livresVoyageurs/public/assets/images/avatar/' . $currentMember['avatar_member'], // /livresVoyageurs/public/assets/images/avatar/lolita.jpg
                    'data-allowed-file-extensions' => 'jpg jpeg png'
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

            ->getForm();

        # Update DB
        $formAccount->handleRequest($request);

        if ($formAccount->isValid()) :

            # Get Form Data
            $member = $formAccount->getData();
            
            # Path Image
            $image  = $member['avatar_member'];
            if($image) 
            {
                $chemin = PATH_PUBLIC.'/assets/images/avatar/';
                $extension = $image->guessExtension();
                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'jpg';
                }
                $image->move($chemin, $this->generateSlug($member['pseudo_member']).'.'.$extension);
            };

            # Connect to DB : Register a new member
            $memberDb = $app['idiorm.db']->for_table('members')->find_one($app['user']->getId_member());
            $memberDb->pseudo_member        = $member['pseudo_member'];
            $memberDb->mail_member          = $member['mail_member'];
            if($image)
            {
                $memberDb->avatar_member    = $this->generateSlug($member['pseudo_member']) . '.' . $extension ;
            }
            $memberDb->save();

            # Redirection
            return $app->redirect('?account=success');

        endif;



        # 4-b : Update Account - Password
        $formAccountPass = $app['form.factory']->createBuilder(FormType::class)
        
            # Form Fields
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
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

            ->getForm();

        # Update DB
        $formAccountPass->handleRequest($request);

        if ($formAccountPass->isValid()) :

            # Connect to DB : Register a new member
            $memberPass = $formAccountPass->getData();

            $memberPassDb = $app['idiorm.db']->for_table('members')->find_one($app['user']->getId_member());
            $memberPassDb->pass_member          = $app['security.encoder.digest']->encodePassword($memberPass['pass_member'], '');
            $memberPassDb->save();

            # Redirection
            return $app->redirect('pass=success');

        endif;


        # 5 : Books registered by the user
        $bookList = $app['idiorm.db']->for_table('view_books')
                                        ->where('id_member', $app['user']->getId_member())
                                        ->find_result_set();	

            
        # 6 : user's pending friends
        $pendingList = $app['idiorm.db']->for_table('view_friends')
                                        ->where_any_is(array(
                                                array('id_member_1'  =>  $currentMember['id_member'], 'status_friend' => 0 ),
                                                array('id_member_2'  =>  $currentMember['id_member'], 'status_friend' => 0 )
                                        ))
                                        ->where_not_equal('action_friend', $currentMember['id_member'])
                                        ->order_by_desc('date_friend')
                                        ->find_result_set();
        # 7 : user's friends
        $friendList = $app['idiorm.db']->for_table('view_friends')
                                        ->where_any_is(array(
                                                array('id_member_1'  =>  $currentMember['id_member'], 'status_friend' => 1 ),
                                                array('id_member_2'  =>  $currentMember['id_member'], 'status_friend' => 1 )
                                        ))
                                        ->where_not_equal('action_friend', $currentMember['id_member'])
                                        ->order_by_desc('date_friend')
                                        ->find_result_set();

        # 8 : Return all to the view                                
        return $app['twig']->render('member/espacePerso.html.twig', [
            'pseudo'           => $pseudo,
            'formAddBook'      => $formAddBook->createView(),
            'formAccount'      => $formAccount->createView(),
            'formAccountPass'  => $formAccountPass->createView(),
            'formCapture'      => $formCapture->createView(),
            'bookList'         => $bookList,
            'pendingList'      => $pendingList,
            'friendList'       => $friendList
        ]);
    }

}