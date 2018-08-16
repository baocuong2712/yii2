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
            [['id'], 'integer'],
            [['price_per_day'], 'number'],
            [['date_from', 'date_to', 'reservation_date', 'room.floor', 'customer.name'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['room.floor', 'customer.name']);
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
        $query->joinWith('room')->joinWith('customer');

        // add conditions that should always apply here
        if (isset($_GET['Reservation']['customer_id'])) {
            $query->where(["=", 'customer_id', $_GET['Reservation']['customer_id']]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['room.floor'] = [
            'asc' => ['room.floor' => SORT_ASC],
            'des' => ['room.floor' => SORT_DESC]
        ];
        $dataProvider->sort->attributes['customer.name'] = [
            'asc' => ['customer.name' => SORT_ASC],
            'des' => ['customer.name' => SORT_DESC]
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
        ])->andFilterWhere(['like', 'room.floor', $this->getAttribute('room.floor')
        ])->andFilterWhere(['LIKE', 'customer.name', $this->getAttribute('customer.name')]);

        return $dataProvider;
    }
}
