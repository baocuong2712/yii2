<?php /** @noinspection ALL */

namespace app\models;

use Yii;
use yii\web\Session;

/**
 * This is the model class for table "reservation".
 *
 * @property int $id
 * @property int $room_id
 * @property int $customer_id
 * @property string $price_per_day
 * @property string $date_from
 * @property string $date_to
 * @property string $reservation_date
 *
 * @property Room $room
 * @property Customer $customer
 */
class Reservation extends \yii\db\ActiveRecord
{
    public $block;
    public $hotel;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'customer_id', 'price_per_day', 'date_from', 'date_to'], 'required'],
            [['room_id', 'customer_id'], 'integer'],
            [['price_per_day'], 'number'],
            [['reservation_date'], 'safe'],
            [['date_from'],  function($attribute, $params) {
                $today = date('y-m-d');
                $seletedDay = date($this->$attribute);

                if (strtotime($seletedDay) < strtotime($today)) {
                    $this->addError($attribute, 'Bạn đã nhập ngày cũ, vui lòng chọn lại!');
                }
                Yii::$app->getSession()->setFlash('date_from', $seletedDay);
            }],
            [['date_to'], function($attribute, $params) {
                $today = strtotime(date('y-m-d'));
                $seletedDay = strtotime(date($this->$attribute));
                $dateFrom = strtotime(Yii::$app->session->getFlash('date_from'));

                if ($seletedDay < $today) {
                    $this->addError($attribute, 'Bạn đã nhập ngày cũ so với hiện tại, vui lòng chọn lại!');
                } else if ($seletedDay < $dateFrom) {
                    $this->addError($attribute, 'Date To không được nhỏ hơn Date From!');
                } else {}
            }],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_id' => 'Room number',
            'customer_id' => 'Customer Name',
            'price_per_day' => 'Price Per Day',
            'block' => 'Block',
            'hotel' => 'Hotel',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'reservation_date' => 'Reservation Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
