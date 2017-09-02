<?php

namespace LivresVoyageurs\Controller;

use Dompdf\Dompdf;
use LivresVoyageurs\Traits\Shortcut;
use LivresVoyageurs\Traits\TestIdBook;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use LivresVoyageurs\Constraints\passConstraint;

class  MemberController
{

    use Shortcut;
    use TestIdBook;


    //Display Personal Space
    public function espacePersoAction(Application $app, Request $request, $pseudo) {


        # 1 : Get some infos

        # 1-a Current member
        $currentMember = $app['idiorm.db']->for_table('members')
        ->find_one($app['user']->getId_member());

        # 1-b Book categories
        $categories = function() use($app) {
            # Get cat from DB
            $categories = $app['idiorm.db']->for_table('categories')->find_result_set();
            # Format (ChoiceType)
            $array = [];
            foreach ($categories as $categorie) :
                $array[$categorie->name_category] = $categorie->id_category;
            endforeach;
            # Return
            return $array;

        };


        # 2: Add a book

        # Create the form
        $formAddBook = $app['form.factory']->createNamedBuilder('formAddBook', FormType::class)

            # Field by Google book Api
            ->add('id_member', HiddenType::class, [
                'required'      =>  true,
                'attr'          => [
                    'value'     => $currentMember['id_member']
                ]
            ])
            ->add('photo_book', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('authors', HiddenType::class, [
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
            # Field by the member
            ->add('ISBN_book', TextType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank(array('message'=>'Vous n\'avez pas indiqué l\'ISBN'))),
                'attr'          =>  [
                    'class'     => 'form-control',
                    'placeholder'   => '000-0-0000-0000-0',
                    'autocomplete'  => 'off'

                ]
            ])
            ->add('id_category', ChoiceType::class, [
                'choices'       => $categories(),
                'expanded'      => false,
                'multiple'      => false,
                'label'         => false,
                'attr'          =>  [
                    'class'     => 'form-control'
                ]
            ])
            # Address
            ->add('addressStart', TextType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank(array('message'=>'Vous n\'avez pas indiqué votre ville'))),
                'attr' => [
                    'class'    => 'form-control'
                ]
            ])
            ->add('city_startpoint', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('lat_startpoint', HiddenType::class, [
                'required'      =>  false
            ])
            ->add('lng_startpoint', HiddenType::class, [
                'required'      =>  false
            ])
            # Is the book available for the community ?
            ->add('disponibility_book', ChoiceType::class , array(
                'choices'                   =>  array(
                'Libération dans la nature' =>  '0',
                'Libération controlée'      =>  '1'
                ),
                'multiple'      =>  false,
                'expanded'      =>  true,
                'required'      =>  true,
                'label'        =>  false,
                'data'         =>  '0'
            ))
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

            ->getForm();

        if ($request->request->has("formAddBook") ){
            $formAddBook->handleRequest($request);
        }
        # If form Valid
        if ($formAddBook->isValid() && $formAddBook->isSubmitted()) :

            # $book = form fields
            $book = $formAddBook->getData();

            # A - Generate unique identifier for the book
            # Loop: generate Id and return true while exist
            # Using the function: isUsed (Trait) to check if ID exist in db
            function bcid($lenght) {
                $number = '';
                for($i = 0; $i<$lenght; $i++)
                {
                    $number.= rand(0,9);
                }
                return $number;
            }


            $generateIdBook = bcid(8);

            while( $this->isUsed( $app, $generateIdBook) ) {
                $generateIdBook = bcid(8);
            }
            # if not in DB : create $idBook
            $idBook = $generateIdBook;

            # B- authors
            # Separate firstname and lastname
            $name = explode(" ", $book['authors']);
            $firstname = $name[0];
            $lastname = $name[1];
            # Check if author exist
            $checkAuthor = $app['idiorm.db']->for_table('authors')
                ->where('firstname_author', $firstname)
                ->where('lastname_author', $lastname)
                ->find_one();

            # if exists: Get authors id from table authors
            if ($checkAuthor)
            {
                $idAuthor = $checkAuthor->id();
            }
            # else: create author
            else
            {
                $newAuthor = $app['idiorm.db']->for_table('authors')->create();
                $newAuthor->firstname_author = $firstname;
                $newAuthor->lastname_author = $lastname;
                $newAuthor->save();
                #get last inserted Id
                $idAuthor = $newAuthor->id();
            }
            # C- Connect to DB : Register a new book
            $bookDb = $app['idiorm.db']->for_table('books')->create();
            $bookDb->id_book             = $idBook;
            $bookDb->id_member           = $currentMember['id_member'];
            $bookDb->id_author           = $idAuthor;
            $bookDb->id_category         = $book['id_category'];
            $bookDb->title_book          = $book['title_book'];
            $bookDb->summary_book        = $book['summary_book'];
            $bookDb->photo_book          = $book['photo_book'];
            $bookDb->ISBN_book           = $book['ISBN_book'];
            $bookDb->disponibility_book  = $book['disponibility_book'];
            $bookDb->language_book       = $book['language_book'];
            $bookDb->pseudo_capture      = $currentMember['pseudo_member'];
            $bookDb->save();

            # D- Create Startpoint
            $bookDb = $app['idiorm.db']->for_table('startpoints')->create();
            $bookDb->id_book             = $idBook;
            $bookDb->lat_startpoint      = $book['lat_startpoint'];
            $bookDb->lng_startpoint      = $book['lng_startpoint'];
            $bookDb->city_startpoint     = $book['city_startpoint'];
            $bookDb->save();


            # Redirection
            return $app->redirect('?addBook=success&idBook=' . $idBook . '&title=' . $book['title_book']);

        endif;


        #3 : Capture
        $formCapture = $app['form.factory']->createNamedBuilder("formCapture", FormType::class)

            # Form Fields
            ->add('id_book', TextType::class, [
                'required'          =>  true,
                'label'             =>  false,
                'constraints'       =>  array(
                    new Regex(
                    array(
                        'pattern'   => '/[0-9]/{8}',
                        'match'     => false,
                        'message'   => 'Numéro incorrect - Doit contenir 8 chiffres')),
                    new NotBlank(array(
                        'message'   => 'Vous devez saisir un numéro')),
                    ),
                'attr'              =>  [
                    'class'         => 'form-control',
                    'autocomplete'  => 'off'
                ]
            ])
            ->add('address', TextType::class, [
                'required'      =>  true,
                'constraints'   =>  array(new NotBlank(array('message'=>'Vous n\'avez pas indiqué votre ville'))),
                'label'         =>  false,
                'attr'          => [
                    'class'     => 'form-control'
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
        if ($request->request->has("formCapture") ){
            $formCapture->handleRequest($request);
        }
        // Check if form is valid
        if ($formCapture->isSubmitted() && $formCapture->isValid()) :

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
            $captureDb->id_member            = $currentMember['id_member'];
            $captureDb->comment_capture      = $capture['comment_capture'];
            $captureDb->save();

            # Connect to DB : Set the book as unavailable
            $bookDb =  $app['idiorm.db']->for_table('books')->find_one($capture['id_book']);
            $bookDb->disponibility_book      = 0;
            $bookDb->pseudo_capture          = $currentMember['pseudo_member'];
            $bookDb->save();

            # Redirection
            return $app->redirect('?capture=success');

        endif;






        # 4-a : Update Account Infos
        $formAccount = $app['form.factory']->createNamedBuilder("formAccount", FormType::class)

            # Form Fields
            ->add('pseudo_member', TextType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank(array('message' => 'Vous n\'avez pas indiqué votre Pseudo' ))),
                'attr'          =>  [
                    'class'     => 'form-control',
                    'value'     => $currentMember['pseudo_member']
                ]
            ])
            ->add('mail_member', EmailType::class, [
                'required'      =>  true,
                'label'         =>  false,
                'constraints'   =>  array(new NotBlank(array('message' => 'Vous n\'avez pas indiqué votre Email')), new Email(
                    array(
                        'message' => 'Veuillez saisir une adresse mail valide',
                        'strict'  => true,
                        'checkMX' => true
                    )
                )),
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
                    // 'data-default-file'            => '/livresVoyageurs/public/assets/images/avatar/' . $currentMember['avatar_member'],
                    'data-allowed-file-extensions' => 'jpg jpeg png'
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

            ->getForm();

        # Handle Post data
        if ($request->request->has("formAccount") ){
            $formAccount->handleRequest($request);
        }
        # If form is valid
        if ($formAccount->isSubmitted() && $formAccount->isValid()) :

            # Get Form Data
            $member = $formAccount->getData();

            # Path Image
            $image  = $member['avatar_member'];
            if($image)
            {
                #1. Removing the old avatar
                $path = PATH_IMAGES . '/avatar/' . $currentMember['avatar_member'];
                unlink($path);
                #2. Define the path
                $chemin = PATH_PUBLIC.'/assets/images/avatar/';
                #3. Get the extension
                $extension = $image->guessExtension();
                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'jpg';
                }
                #4. Save the new image
                $image->move($chemin, $this->generateSlug($currentMember['pseudo_member']).'.'.$extension);
            };
            if( $member['pseudo_member'] != $currentMember['pseudo_member'] )
            {
                # Check if user mail does not exist
                $checkUser = $app['idiorm.db']->for_table('members')
                ->where('pseudo_member', $member['pseudo_member'])
                ->count();
                # If the mail does not exist
                if(!$checkUser)
                {
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
                }
                else
                {
                    # Redirection
                    return $app->redirect('?account=exist');
                }
            }
            else
            {
                # Connect to DB : Register a new member
                $memberDb = $app['idiorm.db']->for_table('members')->find_one($app['user']->getId_member());
                $memberDb->mail_member          = $member['mail_member'];
                if($image)
                {
                    $memberDb->avatar_member    = $this->generateSlug($currentMember['pseudo_member']) . '.' . $extension ;
                }
                $memberDb->save();

                # Redirection
                return $app->redirect('?account=success');
            }

        endif;



        # 4-b : Update Account - Password
        $formAccountPass = $app['form.factory']->createNamedBuilder("formPass", FormType::class)

            # Form Fields
            ->add('pass_member', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'         => array(
                    'label'             => false,
                    'constraints'       => array(new passConstraint()),
                    'attr'              => [
                        'placeholder'   => 'Entrez votre mot de passe',
                        'class'         => 'form-control'
                    ]
                ),
                'second_options' => array(
                    'label' => false,
                    'attr' => [
                        'placeholder'   => 'Confirmez votre mot de passe',
                        'class'         => 'form-control'
                    ]
                ),
                'invalid_message' => 'Les deux mots de passe doivent être identiques',
                'attr' => [
                    'class'             => 'form-control'
                    ]
            ))
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

            ->getForm();

        # Handle request
        if ($request->request->has("formPass") ){
            $formAccountPass->handleRequest($request);
        }
        # If form is valid
        if ( $formAccountPass->isSubmitted() && $formAccountPass->isValid() ) :

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
                                        ->order_by_desc('date_book')
                                        ->find_result_set();



        # 6 : user's pending friends
        $pendingList = $app['idiorm.db']->for_table('view_friends')
                                        ->where_any_is(array(
                                                array('id_member_1'  =>  $currentMember['id_member'], 'status_friend' => 0 ),
                                                array('id_member_2'  =>  $currentMember['id_member'], 'status_friend' => 0 )
                                        ))
                                        ->where_not_equal('action_friend', $currentMember['id_member'])
                                        ->where_not_equal('pseudo_member_1', 'anonyme')
                                        ->where_not_equal('pseudo_member_2', 'anonyme')
                                        ->order_by_desc('date_friend')
                                        ->find_result_set();
        # 7 : user's friends
        $friendList = $app['idiorm.db']->for_table('view_friends')
                                        ->where_any_is(array(
                                                array('id_member_1'  =>  $currentMember['id_member'], 'status_friend' => 1 ),
                                                array('id_member_2'  =>  $currentMember['id_member'], 'status_friend' => 1 )
                                        ))
                                        ->where_not_equal('pseudo_member_1', 'anonyme')
                                        ->where_not_equal('pseudo_member_2', 'anonyme')
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


    # Change disponibility
    public function espacePersoPost(Application $app, Request $request) {

        # Connect to DB : Register the book as unavailable
        $bookDispoDb = $app['idiorm.db']->for_table('books')->find_one($request->get('id_book'));
        $bookDispoDb->disponibility_book = $request->get('disponibility_book');
        $bookDispoDb->save();

        # Redirection
        return $app->redirect( $app['url_generator']->generate('livresVoyageurs_espace', array('pseudo' => $app['user']->getPseudo_member() ) ) );
    }

    # Sticker creation
    public function stickerAction(Application $app, Request $request, $uniqueId, $title) {

        # Instanciate a new Dompdf object
        $sticker = new Dompdf();
        # Set path to assets folder
        $sticker->setBasePath(PATH_PUBLIC . "/assets/");
        # Load HTML file using Twig
        $sticker->loadHtml($app['twig']->render('sticker.html.twig', [
            'uniqueId' => $uniqueId,
            'title'    => $title
        ]));
        # Render pdf
        $sticker->render();
        # Attach the file to the browser (Attachement: option to display the pdf)
        $sticker->stream('sticker.pdf',array('Attachment'=>0));
    }



    # Delete account
    public function deleteAction(Application $app) {

        # Current member
        $deleteMember = $app['idiorm.db']->for_table('members')
                                            ->find_one($app['user']->getId_member());
        $deleteMember->pseudo_member   = 'anonyme';
        $deleteMember->mail_member     = '';
        $deleteMember->pass_member     = '';
        $deleteMember->avatar_member   = '';
        $deleteMember->role_member     = '';
        $deleteMember->active_member   = 0;
        $deleteMember->save();


        # Empty Session
        $app['session']->clear();

        # Redirection
        return $app->redirect( $app['url_generator']->generate('livresVoyageurs_home'));
    }



    # Display Chat Page
    public function chatAction(Application $app, $receiver) {

        # Define messages sender
        // $sender = $app['pseudo'];
$sender = 'Loic';

        return $app['twig']->render('member/chat.html.twig', [
            'receiver' => $receiver,
            'sender'   => $sender
        ]);
    }

}
