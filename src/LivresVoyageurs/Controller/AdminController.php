<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;
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
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\Request;

class  AdminController
{

    //Display Administation Page
    public function administrateurAction(Application $app, Request $request, $pseudoAdmin) {


        # Delete a member

            # Deal with categories
            // $categories = function() use($app) {            
                # Get cat from DB
                $categories = $app['idiorm.db']->for_table('categories')->find_result_set();        
            //     # Format (ChoiceType)
            //     $array = [];
            //     foreach ($categories as $categorie) :
            //         $array[$categorie->name_category] = $categorie->id_category;
            //     endforeach;
            //     # Return
            //     return $array;
            
            // };

            # Add a category
            # Form
            $formAddCat = $app['form.factory']->createBuilder(FormType::class)

                ->add('name_category', TextType::class, [                
                    'required'      =>  true,
                    'label'         =>  false,
                    'attr' => [
                        'class'    => 'form-control'
                    ]
                ])
                ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

                ->getForm();
            
            $formAddCat->handleRequest($request);            
            # If form Valid   
            if ($formAddCat->isValid()) :            
                # $cat = form field
                $cat = $formAddCat->getData(); 
                # Persist in DB
                $addCat = $app['idiorm.db']->for_table('categories')->create();
                $addCat->name_category = $cat['name_category'];
                $addCat->save();
                # Redirection
                return $app->redirect('?addCat=success');
            
            endif;



        # Modify a category
        // if ($formModifCat->isValid()) :  
        //     # Persist in DB
        //     $modifCat = $app['idiorm.db']->for_table('categories')->find_one($modif['id_category']);
        //     $modifCat->name_category = $cat['name_category'];
        //     $modifCat->save();
        //     # Redirection
        //     return $app->redirect('?modifCat=success');
        // endif;

        // # Delete a category
        // if ($formDelCat->isValid()) :  
        //     $modifCat = $app['idiorm.db']->for_table('categories')->find_one($modif['id_category']);
        //     $modifCat->delete();

        //     return $app->redirect('?delCat=success');
        // endif;


        # Add an Admin

            # A- Search for a member by pseudo and return it's ID
                $formMember = $app['form.factory']->createBuilder(FormType::class)
                
                    ->add('pseudo_member', TextType::class, [                
                        'required'      =>  true,
                        'label'         =>  false,
                        'attr' => [
                            'class'    => 'form-control'
                        ]
                    ])
                    ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

                    ->getForm();
                
                $formMember->handleRequest($request);            
                # If form Valid   
                if ($formMember->isValid()) :            
                    # $pseudo = form field
                    $member = $formMember->getData(); 
                    # Check in DB
                    $memberDb = $app['idiorm.db']->for_table('members')
                        ->where('pseudo_member', $member['pseudo_member'])
                        ->find_one();
                    # Get ID
                    $id_member = $memberDb->id();
                    # Redirection
                    return $app->redirect('?idMember=success&pseudo=' . $member['pseudo_member'] .'&id_member=' . $id_member);            
                endif;

            # B- Change Role by Id

                $formRole = $app['form.factory']->createBuilder(FormType::class)
                
                    ->add('id_member', TextType::class, [                
                        'required'              =>  true,
                        'label'                 =>  false,
                        'attr'                  => [
                            'class'             => 'form-control'
                        ]
                    ])
                    ->add('role_member', ChoiceType::class , array(
                        'choices'               =>  array(
                        'Role Membre'           =>  'ROLE_MEMBER',
                        'Role Administrateur'   =>  'ROLE_ADMIN'
                        ),
                        'multiple'              =>  false,
                        'expanded'              =>  true,
                        'required'              =>  true,
                        'label'                 =>  false,
                        'data'                  =>  'ROLE_MEMBER'
                    ))
                    ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

                    ->getForm();
                
                $formRole->handleRequest($request);            
                # If form Valid   
                if ($formRole->isValid()) :            
                    # $pseudo = form field
                    $role = $formRole->getData(); 
                    # Check in DB
                    $roleDb = $app['idiorm.db']->for_table('members')->find_one($role['id_member']);
                    $roleDb->role_member = $role['role_member'];
                    $roleDb->save();
                    # Redirection
                    return $app->redirect('?changeRole=success');            
                endif;

                # C- Change Role by Pseudo

                $formRole2 = $app['form.factory']->createBuilder(FormType::class)
                
                    ->add('pseudo_member', TextType::class, [                
                        'required'              =>  true,
                        'label'                 =>  false,
                        'attr'                  => [
                            'class'             => 'form-control'
                        ]
                    ])
                    ->add('role_member', ChoiceType::class , array(
                        'choices'               =>  array(
                        'Role Membre'           =>  'ROLE_MEMBER',
                        'Role Administrateur'   =>  'ROLE_ADMIN'
                        ),
                        'multiple'              =>  false,
                        'expanded'              =>  true,
                        'required'              =>  true,
                        'label'                 =>  false,
                        'data'                  =>  'ROLE_MEMBER'
                    ))
                    ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

                    ->getForm();
                
                $formRole2->handleRequest($request);            
                # If form Valid   
                if ($formRole2->isValid()) :            
                    # $pseudo = form field
                    $role = $formRole2->getData(); 
                    # Check in DB
                    $roleDb = $app['idiorm.db']->for_table('members')
                        ->where('pseudo_member', $role['pseudo_member'])
                        ->find_one();
                    $roleDb->role_member = $role['role_member'];
                    $roleDb->save();
                    # Redirection
                    return $app->redirect('?changeRole=success');            
                endif;


        # Stats
        # Number of members
        $members = $app['idiorm.db']->for_table('members')->count();

        # Number of available books
        $availableBooks = $app['idiorm.db']->for_table('books')
                                        ->where('disponibility_book', 1)
                                        ->count();

        # Total of boooks created on the platform
        $books = $app['idiorm.db']->for_table('books')->count();

        # Chart: books by category

        # Chart: books by country

        
        // View
        return $app['twig']->render('private/admin.html.twig', [
            'members'           => $members,
            'availableBooks'    => $availableBooks,
            'books'             => $books,
            'formAddCat'        => $formAddCat->createView(),
            'formMember'        => $formMember->createView(),
            'formRole'          => $formRole->createView(),
            'formRole2'          => $formRole2->createView(),
            'categories'        => $categories
        ]);
    }

}
