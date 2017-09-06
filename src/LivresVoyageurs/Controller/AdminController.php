<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;

class  AdminController
{

    //Display Administation Page
    public function administrateurAction(Application $app, Request $request, $pseudoAdmin) {

            # Deal with categories
                # Get cat from DB
                $categories = $app['idiorm.db']->for_table('categories')
                ->find_result_set();

                $catNotUsed = $app['idiorm.db']->for_table('books')
                ->select('categories.id_category')
                ->right_outer_join('categories',
                    array('categories.id_category', '=', 'books.id_category'))
                ->where_null('books.id_category')
                ->find_many();


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
                    # Check if pseudo_member exist
                    $exist = $app['idiorm.db']->for_table('members')
                                                ->where('pseudo_member', $member['pseudo_member'])
                                                ->count();
                    if ($exist) {
                        $memberDb = $app['idiorm.db']->for_table('members')
                        ->where('pseudo_member', $member['pseudo_member'])
                        ->find_one();
                        # Get ID
                        $id_member = $memberDb->id();
                        # Redirection
                        return $app->redirect('?idMember=success&pseudo=' . $member['pseudo_member'] .'&id_member=' . $id_member);
                    }
                    else {
                        return $app->redirect('?idMember=fail');
                    }
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
                    # Check if exist
                    $exist = $app['idiorm.db']->for_table('members')
                                                ->where('id_member', $member['id_member'])
                                                ->count();
                    if ($exist) {

                        # Check in DB
                        $roleDb = $app['idiorm.db']->for_table('members')->find_one($role['id_member']);
                        $roleDb->role_member = $role['role_member'];
                        $roleDb->save();
                        # Redirection
                        return $app->redirect('?changeRole=success');
                    }
                    else {
                        return $app->redirect('?changeRole=fail');
                    }

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

                    $exist = $app['idiorm.db']->for_table('members')
                                                ->where('pseudo_member', $member['pseudo_member2'])
                                                ->count();
                    if ($exist) {
                        # Check in DB
                        $roleDb = $app['idiorm.db']->for_table('members')
                            ->where('pseudo_member', $role['pseudo_member2'])
                            ->find_one();
                        $roleDb->role_member = $role['role_member2'];
                        $roleDb->save();
                        # Redirection
                        return $app->redirect('?changeRole=success');
                    }
                    else {
                        return $app->redirect('?changeRole=fail');
                    }
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
                # Check if exists
                $exist = $app['idiorm.db']->for_table('members')
                                            ->where('id_member', $member['id_member3'])
                                            ->count();
                if ($exist) {
                    $deleteMember = $app['idiorm.db']->for_table('members')
                        ->find_one($member['id_member3']);
                    $deleteMember->pseudo_member   = 'anonyme';
                    $deleteMember->mail_member     = '';
                    $deleteMember->pass_member     = '';
                    $deleteMember->avatar_member   = 'default.png';
                    $deleteMember->role_member     = '';
                    $deleteMember->active_member   = 0;
                    $deleteMember->save();
                    # Redirection
                    return $app->redirect('?delete=success');
                }
                else {
                    return $app->redirect('?delete=fail');
                }
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
                # Check if exists
                $exist = $app['idiorm.db']->for_table('members')
                                            ->where('pseudo_member', $member['pseudo_member3'])
                                            ->count();
                if ($exist) {
                    $deleteMember = $app['idiorm.db']->for_table('members')
                        ->where('pseudo_member', $member['pseudo_member3'])
                        ->find_one();
                        $deleteMember->pseudo_member   = 'anonyme';
                        $deleteMember->mail_member     = '';
                        $deleteMember->pass_member     = '';
                        $deleteMember->avatar_member   = 'default.png';
                        $deleteMember->role_member     = '';
                        $deleteMember->active_member   = 0;
                        $deleteMember->save();
                    # Redirection
                    return $app->redirect('?delete=success');
                }
                else {
                    return $app->redirect('?delete=fail');
                }

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


        # Chart: inscriptions by month
        $inscriptionsByMonth = $app['idiorm.db']->for_table('members')
            ->raw_query("SELECT CASE EXTRACT(MONTH
                        FROM date_member) WHEN 1 Then 'Janvier'
                        WHEN 2 then 'Février'
                        WHEN 3 then 'Mars'
                        WHEN 4 Then 'Avril'
                        WHEN 5 Then 'Mai'
                        WHEN 6 Then 'Juin'
                        WHEN 7 then 'Juillet'
                        WHEN 8 then 'Août'
                        WHEN 9 then 'Septembre'
                        WHEN 10 then 'Octobre'
                        WHEN 11 then 'Novembre'
                        WHEN 12 then 'Décembre'
                        END as month,
                        COUNT(*) as count
                        FROM `members`
                        GROUP BY MONTH(`date_member`)")
            ->find_many();

        $tableMonth = array();
        $rowMonth = array();
        $tableMonth['cols'] = array(
            array('label' => 'Mois', 'type' => 'string'),
            array('label' => 'Nombre d\'inscriptions', 'type' => 'number')
            );
        for ($i=0; $i < count($inscriptionsByMonth); $i++) {
            $ligneMonth = $inscriptionsByMonth[$i];
            $temp = array();
            $temp[] = array ('v' => $ligneMonth['month']);
            $temp[] = array('v' => $ligneMonth['count']);
            $rowMonth[] = array('c' => $temp);
            }
        $tableMonth['rows'] = $rowMonth;

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


        # Chart: books by category
        $booksByCat = $app['idiorm.db']->for_table('view_books')
            ->select('name_category')
            ->select_expr('COUNT(*)', 'count')
            ->group_by('name_category')
            ->find_many();

        $tableCat = array();
        $rowCat = array();
        $tableCat['cols'] = array(
            array('label' => 'Catégories', 'type' => 'string'),
            array('label' => 'Nombre de Livres', 'type' => 'number')
            );
        for ($i=0; $i < count($booksByCat); $i++) {
            $ligneCat = $booksByCat[$i];
            $temp = array();
            $temp[] = array ('v' => $ligneCat['name_category']);
            $temp[] = array('v' => $ligneCat['count']);
            $rowCat[] = array('c' => $temp);
            }
        $tableCat['rows'] = $rowCat;


        // View
        return $app['twig']->render('private/admin.html.twig', [
            'members'               => $members,
            'availableBooks'        => $availableBooks,
            'books'                 => $books,
            'formAddCat'            => $formAddCat->createView(),
            'formMember'            => $formMember->createView(),
            'formRole'              => $formRole->createView(),
            'formRole2'             => $formRole2->createView(),
            'formDel'               => $formDel->createView(),
            'formDel2'              => $formDel2->createView(),
            'categories'            => $categories,
            'inscriptionsByMonth'   => $tableMonth,
            'membersByCity'         => $tableCity,
            'booksByCat'            => $tableCat,
            'catNotUsed'            => $catNotUsed
        ]);
    }

    // Change a category
    public function changeCatAction(Application $app, Request $request, $id){
        if ($request->isMethod('POST')) {
            # 1. Check if the name already exist
            $name  = $request->get('name_category');
            $exist = $app['idiorm.db']->for_table('categories')
                    ->where('name_category', $name)
                    ->count();
            # 2. Change the name of the category
            if (!$exist) {
                # Connect to database
                $change = $app['idiorm.db']->for_table('categories')
                        ->find_one($id);
                # Update entry
                $change->name_category = $name;
                $change->save();

                # Redirect
                return $app->redirect($app['url_generator']->generate('livresVoyageurs_administrator', array('pseudoAdmin' => $app['user']->getPseudo_member(),
                    'change'      => 'true',
                    'id'          => $id
                ) ) );
            }
            else {
                return $app->redirect($app['url_generator']->generate('livresVoyageurs_administrator', array('pseudoAdmin' => $app['user']->getPseudo_member(),
                    'exist'       => 'true',
                    'name'        => $name
                ) ) );
            }
        }
    }

    // Delete a category
    public function removeCatAction(Application $app, $id_category){

            # 1. Retrieve the category
            $delete = $app['idiorm.db']->for_table('categories')
                                        ->find_one($id_category);
            # 2. delete the category
            $delete->delete();

            # 3. Redirect
            return $app->redirect( $app['url_generator']->generate('livresVoyageurs_administrator', array('pseudoAdmin' => $app['user']->getPseudo_member(),
                'delete' => 'true'
            ) ) );
        // }
    }

}
