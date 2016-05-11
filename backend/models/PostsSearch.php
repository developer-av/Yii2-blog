<?php

namespace developerav\blog\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use developerav\blog\common\models\Posts;

/**
 * PostsSearch represents the model behind the search form about `developerav\blog\common\models\Posts`.
 */
class PostsSearch extends Posts {

    public $user;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user', 'title'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {

        $query = Posts::find()->with('user');

        $query->joinWith('user');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $dataProvider->sort->attributes['user'] = [
            'asc' => ['user.'.\Yii::$app->controller->module->userField => SORT_ASC],
            'desc' => ['user.'.\Yii::$app->controller->module->userField => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', \Yii::$app->controller->module->userField, $this->user]);

        return $dataProvider;
    }

}
