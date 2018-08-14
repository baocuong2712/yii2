<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reservation;

/**
 * ReservationSearch represents the model behind the search form of `app\models\Reservation`.
 */
class ReservationSearch extends Reservation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id'], 'integer'],
            [['price_per_day'], 'number'],
            [['date_from', 'date_to', 'reservation_date', 'room.room_number'], 'safe'],
        ];
    }

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['room.room_number']);
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Reservation::find();

        // add conditions that should always apply here
        // Join with relation `room` that is a relation to the table `rooms` and set the table alias to be `room`
        $query->joinWith(['room']);
        // Since version 2.0.7, the above line can be simplified to $query->joinWith('author AS author');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Enable sorting for the related column
        $dataProvider->sort->attributes['room.room_number'] = [
            'asc' => ['room.room_number' => SORT_ASC],
            'desc' => ['room.room_number' => SORT_ASC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'room_id' => $this->room_id,
            'customer_id' => $this->customer_id,
            'price_per_day' => $this->price_per_day,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'reservation_date' => $this->reservation_date,
        ])->andFilterWhere(['LIKE', 'room.room_number', $this->getAttribute('room.room_number')]);


        return $dataProvider;
    }
}
