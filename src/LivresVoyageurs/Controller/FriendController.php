<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;


class  FriendController
{



    # Add Friend
    public function addFriendAction(Application $app, $pseudo) {

        # Current member
        $currentMember = $app['idiorm.db']->for_table('members')
        ->find_one($app['user']->getId_member());

        # Look for friend's ID
        $idFriend = $app['idiorm.db']->for_table('members')
        ->where('pseudo_member', $pseudo)
        ->find_one();
        # Look for the smallest ID
        if( $currentMember['id_member'] < $idFriend->id_member )
        {
            $id1 = $currentMember['id_member'];
            $id2 = $idFriend->id_member;
        }
        else 
        {
            $id1 = $idFriend->id_member;
            $id2 = $currentMember['id_member']; 
        }

        # Friend request
        $checkFriend = $app['idiorm.db']->for_table('friends')
        ->where_any_is(array(
            array('id_member_1'  =>  $id1 , 'id_member_2' => $id2 ),
            array('id_member_1'  =>  $id2, 'id_member_2' => $id1 ) ))
        ->count();

        if( $checkFriend )
        {
            return $app->redirect( $app['url_generator']->generate('livresVoyageurs_bookList', array( 'addFriend' => 'exist', 'friend' => $idFriend->pseudo_member)));
        } 
        else
        {
            $addFriendDb = $app['idiorm.db']->for_table('friends')->create();
            $addFriendDb->id_member_1 = $id1;
            $addFriendDb->id_member_2 = $id2;
            $addFriendDb->action_friend = $currentMember['id_member'];
            $addFriendDb->status_friend = 0;
            $addFriendDb->save();
    
            # Redirection
            return $app->redirect( $app['url_generator']->generate('livresVoyageurs_bookList', array( 'addFriend' => 'success', 'friend' => $idFriend->pseudo_member)));
        }
    }


    # Accept Friend
    public function acceptFriendAction(Application $app, $pseudo) {
        
        # Current member
        $currentMember = $app['idiorm.db']->for_table('members')
        ->find_one($app['user']->getId_member());

        # Look for friend's ID
        $idFriend = $app['idiorm.db']->for_table('members')
        ->where('pseudo_member', $pseudo)
        ->find_one();
        # Use variables 
        $id1 = $currentMember['id_member'];
        $id2 = $idFriend->id_member;

        # Friend request
        $checkFriend = $app['idiorm.db']->for_table('friends')
            ->where_any_is(array(
                array('id_member_1'  =>  $id1 , 'id_member_2' => $id2 ),
                array('id_member_1'  =>  $id2, 'id_member_2' => $id1 ) ))
            ->find_one();
        $checkFriend->status_friend = 1;
        $checkFriend->save();
    
        # Redirection
        return $app->redirect( $app['url_generator']->generate('livresVoyageurs_espace', array('pseudo' => $currentMember['pseudo_member'])) . '#friendList');
    }


    # Decline Friend
    public function declineFriendAction(Application $app, $pseudo) {
        
        # Current member
        $currentMember = $app['idiorm.db']->for_table('members')
        ->find_one($app['user']->getId_member());

        # Look for friend's ID
        $idFriend = $app['idiorm.db']->for_table('members')
        ->where('pseudo_member', $pseudo)
        ->find_one();
        # Use variables 
        $id1 = $currentMember['id_member'];
        $id2 = $idFriend->id_member;

        # Friend request
        $checkFriend = $app['idiorm.db']->for_table('friends')
            ->where_any_is(array(
                array('id_member_1'  =>  $id1 , 'id_member_2' => $id2 ),
                array('id_member_1'  =>  $id2, 'id_member_2' => $id1 ) ))
            ->find_one();
        $checkFriend->status_friend = 2;
        $checkFriend->save();
    
        # Redirection
        return $app->redirect( $app['url_generator']->generate('livresVoyageurs_espace', array('pseudo' => $currentMember['pseudo_member'])) . '#friendList');
    }

    # Block Friend
    public function blockFriendAction(Application $app, $pseudo) {
        
        # Current member
        $currentMember = $app['idiorm.db']->for_table('members')
        ->find_one($app['user']->getId_member());

        # Look for friend's ID
        $idFriend = $app['idiorm.db']->for_table('members')
        ->where('pseudo_member', $pseudo)
        ->find_one();
        # Use variables 
        $id1 = $currentMember['id_member'];
        $id2 = $idFriend->id_member;

        # Friend request
        $checkFriend = $app['idiorm.db']->for_table('friends')
            ->where_any_is(array(
                array('id_member_1'  =>  $id1 , 'id_member_2' => $id2 ),
                array('id_member_1'  =>  $id2, 'id_member_2' => $id1 ) ))
            ->find_one();
        $checkFriend->status_friend = 3;
        $checkFriend->save();
    
        # Redirection
        return $app->redirect( $app['url_generator']->generate('livresVoyageurs_espace', array('pseudo' => $currentMember['pseudo_member'])) . '#friendList');
    }

}

