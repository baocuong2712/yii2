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
//        $permissions = [
//            'permissionCreateReservation' => array('desc' => 'Create a reservation'),
//            'updateReservation' => array('desc' => 'Update customer')
//        ];

        // add "createReservation" permission
        $permissionCreateReservation = $auth->createPermission('createReservation');
        $permissionCreateReservation->description = 'Create a reservation';
        $auth->add($permissionCreateReservation);

        // add "updateReservation" permission
        $permissionUpdateReservation = $auth->createPermission('updateReservation');
        $permissionUpdateReservation->description = 'Update reservation';
        $auth->add($permissionUpdateReservation);

        // Add "operator" role and give this role the "createReservation" permission
        $roleOperator = $auth->createRole('operator');
        $auth->add($roleOperator);
        $auth->addChild($roleOperator, $permissionCreateReservation);

        // Add all permissions to admin role
        $roleAdmin = $auth->createRole('admin');
        $auth->add($roleAdmin);
        $auth->addChild($roleAdmin, $permissionUpdateReservation);
        $auth->addChild($roleAdmin, $roleOperator);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId() usually implemented in your User model.
        $auth->assign($roleOperator, 2);
        $auth->assign($roleAdmin, 1);
    }

    public function actionIndex()
    {
        $auth = Yii::$app->authManager;

        // Initialize authorizations
        $this->initializeAuthorizations();

        // Get all users
        $users = User::find()->all();

        // Initialize data
        $rolesAvailable = $auth->getRoles(); // operator, admin
        $rolesNamesByUser = [];

        // For each user, fill $rolesNames with name of roles assigned to user
        foreach($users as $user)
        {
            // Bien nay de luu ten cua tat ca cac role, sau do gan cho...
            $rolesNames = [];

            // Day moi chi la cac doi tuong duoc tra ve, de lay thong tin them, ta can truy suat nua.
            $roles = $auth->getRolesByUser($user->id);
            foreach($roles as $role)
            {
                $rolesNames[] = $role->name;
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