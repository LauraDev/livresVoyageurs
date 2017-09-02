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
                
                    ->add('pseudo_member2', TextType::class, [                
                        'required'              =>  true,
                        'label'                 =>  false,
                        'attr'                  => [
                            'class'             => 'form-control'
                        ]
                    ])
                    ->add('role_member2', ChoiceType::class , array(
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
                        ->where('pseudo_member', $role['pseudo_member2'])
                        ->find_one();
                    $roleDb->role_member = $role['role_member2'];
                    $roleDb->save();
                    # Redirection
                    return $app->redirect('?changeRole=success');            
                endif;



        # Delete a member
            # A- Delete by Id
            $formDel = $app['form.factory']->createBuilder(FormType::class)
            
                ->add('id_member3', TextType::class, [                
                    'required'              =>  true,
                    'label'                 =>  false,
                    'attr'                  => [
                        'class'             => 'form-control'
                    ]
                ])
                ->add('submit', SubmitType::class, ['label' => 'Supprimer'])

                ->getForm();
            
            $formDel->handleRequest($request);            
            # If form Valid   
            if ($formDel->isValid()) :   
                $member = $formDel->getData(); 
                $deleteMember = $app['idiorm.db']->for_table('members')
                    ->find_one($member['id_member3']);
                $deleteMember->pseudo_member   = 'anonyme';
                $deleteMember->mail_member     = '';
                $deleteMember->pass_member     = '';
                $deleteMember->avatar_member   = '';
                $deleteMember->role_member     = '';
                $deleteMember->active_member   = 0;
                $deleteMember->save();
                # Redirection
                return $app->redirect('?delete=success');            
            endif;


            # B- Delete by Pseudo
            $formDel2 = $app['form.factory']->createBuilder(FormType::class)
            
                ->add('pseudo_member3', TextType::class, [                
                    'required'              =>  true,
                    'label'                 =>  false,
                    'attr'                  => [
                        'class'             => 'form-control'
                    ]
                ])
                ->add('submit', SubmitType::class, ['label' => 'Supprimer'])
                
                ->getForm();
            
            $formDel2->handleRequest($request);            
            # If form Valid   
            if ($formDel2->isValid()) :   
                $member = $formDel2->getData();          
                $delete = $app['idiorm.db']->for_table('members')
                                            ->where('pseudo_member', $member['pseudo_member3'])
                                            ->find_one();
                $delete->delete();
                # Redirection
                return $app->redirect('?delete=success');            
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

        // SELECT category, COUNT(*) as count FROM table GROUP BY category
        $booksByCat = $app['idiorm.db']->for_table('view_books')
            ->select('name_category')
            ->select_expr('COUNT(*)', 'count')
            ->group_by('name_category')
            ->find_many();

        $tableCat = array();
        $rowCat = array();
        $tableCat['cols'] = array(
                                array('label' => 'Catégorie', 'type' => 'string'),
                                array('label' => 'Nombre de livres', 'type' => 'number')
                                );
        for ($i=0; $i < count($booksByCat); $i++) {
            $ligneCat = $booksByCat[$i];
            $temp = array();
            $temp[] = array ('v' => $ligneCat['name_category']);
            $temp[] = array('v' => $ligneCat['count']);
            $rowCat[] = array('c' => $temp);
            }
        $tableCat['rows'] = $rowCat;

        # Chart: members by city
        $membersByCity = $app['idiorm.db']->for_table('view_story')
        ->select('city_startpoint')
        ->select_expr('COUNT(*)', 'count')
        ->group_by('city_startpoint')
        ->find_many();

        $tableCity = array();
        $rowCity = array();
        $tableCity['cols'] = array(
                                array('label' => 'Ville', 'type' => 'string'),
                                array('label' => 'Nombre de membres', 'type' => 'number')
                                );
        for ($i=0; $i < count($membersByCity); $i++) {
            $ligneCity = $membersByCity[$i];
            $temp = array();
            $temp[] = array ('v' => $ligneCity['city_startpoint']);
            $temp[] = array('v' => $ligneCity['count']);
            $rowCity[] = array('c' => $temp);
            }
        $tableCity['rows'] = $rowCity;
        
        // View
        return $app['twig']->render('private/admin.html.twig', [
            'members'           => $members,
            'availableBooks'    => $availableBooks,
            'books'             => $books,
            'formAddCat'        => $formAddCat->createView(),
            'formMember'        => $formMember->createView(),
            'formRole'          => $formRole->createView(),
            'formRole2'         => $formRole2->createView(),
            'formDel'           => $formDel->createView(),
            'formDel2'          => $formDel2->createView(),
            'categories'        => $categories,
            'booksByCat'        => $tableCat,
            'membersByCity'     => $tableCity
        ]);
    }

}
