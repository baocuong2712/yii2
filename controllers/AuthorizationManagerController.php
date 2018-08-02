<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 8/2/2018
 * Time: 2:30 PM
 */

namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\models\User;

class AuthorizationManagerController extends Controller {

    public function initializeAuthorizations()
    {
        $auth = Yii::$app->authManager;
        $permissions = [
            'createReservation' => array('desc' => 'Create a reservation'),
            'updateReservation' => array('desc' => 'Update reservation'),
            'deleteReservation' => array('desc' => 'Delete reservation'),
            'createRoom' => array('desc' => 'Create a room'),
            'updateRoom' => array('desc' => 'Update room'),
            'deleteRoom' => array('desc' => 'Delete room'),
            'createCustomer' => array('desc' => 'Create a customer'),
            'updateCustomer' => array('desc' => 'Update customer'),
            'deleteCustomer' => array('desc' => 'Delete customer'),
        ];
        $roles = [
            'operator' => array('createReservation', 'createRoom', 'createCustomer'),
        ];

        // Add all permissions
        foreach($permissions as $keyP=>$valueP)
        {
            $p = $auth->createPermission($keyP);
            $p->description = $valueP['desc'];
            $auth->add($p);

        // Add "operator" role and give this role the "createReservation" permission
            $r = $auth->createRole('role_'.$keyP);
            $r->description = $valueP['desc'];
            $auth->add($r);
            if( false == $auth->hasChild($r, $p)) $auth->addChild($r, $p);
        }

        // Add all roles
        foreach($roles as $keyR=>$valueR)
        {
            $r = $auth->createRole($keyR);
            $r->description = $keyR;
            $auth->add($r);
            foreach($valueR as $permissionName)
            {
                if( false == $auth->hasChild($r, $auth->getPermission($permissionName)))
                    $auth->addChild($r, $auth->getPermission($permissionName));
            }
        }

        // Add all permissions to admin role
        $r = $auth->createRole('admin');
        $r->description = 'admin';
        $auth->add($r);
        foreach($permissions as $keyP=>$valueP)
        {
            if( false == $auth->hasChild($r, $auth->getPermission($permissionName)))
                $auth->addChild($r, $auth->getPermission($keyP));
        }
    }

    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
        // Initialize authorizations
        $this->initializeAuthorizations();
        // Get all users
        $users = User::find()->all();
        // Initialize data
        $rolesAvailable = $auth->getRoles();
        $rolesNamesByUser = [];
        // For each user, fill $rolesNames with name of roles assigned to user
        foreach($users as $user)
        {
            $rolesNames = [];
            $roles = $auth->getRolesByUser($user->id);
            foreach($roles as $r)
            {
                $rolesNames[] = $r->name;
//                echo 'There are ' . $rolesNames;
            }
            $rolesNamesByUser[$user->id] = $rolesNames;
        }
        return $this->render('index', [
            'users' => $users,
            'rolesAvailable' => $rolesAvailable,
            'rolesNamesByUser' => $rolesNamesByUser
        ]);
    }
}