<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Unions;

/**
 * UnionsSearch represents the model behind the search form about `frontend\models\Unions`.
 */
class UnionsSearch extends Unions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_type', 'union_create_time', 'status', 'company_size', 'members'], 'integer'],
            [['user_login', 'user_pass', 'user_email', 'user_phone', 'union_name', 'union_description', 'union_user', 'union_phone', 'union_imgs', 'company_name', 'company_org', 'company_org_img', 'company_license', 'company_license_img', 'company_user', 'company_idcard', 'company_idcard_img_font', 'company_idcard_img_back', 'company_idcard_img_hand', 'company_scope', 'company_phone', 'bank_name', 'bank_account', 'bank_user', 'bank_phone', 'bank_img', 'alipay', 'wxpay'], 'safe'],
            [['balance'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Unions::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_type' => $this->user_type,
            'union_create_time' => $this->union_create_time,
            'status' => $this->status,
            'company_size' => $this->company_size,
            'balance' => $this->balance,
            'members' => $this->members,
        ]);

        $query->andFilterWhere(['like', 'user_login', $this->user_login])
            ->andFilterWhere(['like', 'user_pass', $this->user_pass])
            ->andFilterWhere(['like', 'user_email', $this->user_email])
            ->andFilterWhere(['like', 'user_phone', $this->user_phone])
            ->andFilterWhere(['like', 'union_name', $this->union_name])
            ->andFilterWhere(['like', 'union_description', $this->union_description])
            ->andFilterWhere(['like', 'union_user', $this->union_user])
            ->andFilterWhere(['like', 'union_phone', $this->union_phone])
            ->andFilterWhere(['like', 'union_imgs', $this->union_imgs])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'company_org', $this->company_org])
            ->andFilterWhere(['like', 'company_org_img', $this->company_org_img])
            ->andFilterWhere(['like', 'company_license', $this->company_license])
            ->andFilterWhere(['like', 'company_license_img', $this->company_license_img])
            ->andFilterWhere(['like', 'company_user', $this->company_user])
            ->andFilterWhere(['like', 'company_idcard', $this->company_idcard])
            ->andFilterWhere(['like', 'company_idcard_img_font', $this->company_idcard_img_font])
            ->andFilterWhere(['like', 'company_idcard_img_back', $this->company_idcard_img_back])
            ->andFilterWhere(['like', 'company_idcard_img_hand', $this->company_idcard_img_hand])
            ->andFilterWhere(['like', 'company_scope', $this->company_scope])
            ->andFilterWhere(['like', 'company_phone', $this->company_phone])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'bank_account', $this->bank_account])
            ->andFilterWhere(['like', 'bank_user', $this->bank_user])
            ->andFilterWhere(['like', 'bank_phone', $this->bank_phone])
            ->andFilterWhere(['like', 'bank_img', $this->bank_img])
            ->andFilterWhere(['like', 'alipay', $this->alipay])
            ->andFilterWhere(['like', 'wxpay', $this->wxpay]);

        return $dataProvider;
    }
}
