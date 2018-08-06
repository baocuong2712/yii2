<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 8/3/2018
 * Time: 3:14 PM
 */
namespace app\models;

use app\models\Reservation;

class ReservationSearch extends Reservation
{
    public function attributes()
    {// add related fields to searchable attributes
        return array_merge(parent::attributes(), ['customer.surname']);
    }
    public function rules()
    {
    // add related rules to searchable attributes
        return array_merge(parent::rules(),[ ['customer.surname', 'safe'] ]);
    }
}
?>