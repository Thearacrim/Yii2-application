<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Branches;

/**
 * BranchesSearch represents the model behind the search form of `backend\models\Branches`.
 */
class BranchesSearch extends Branches
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['branch_id'], 'integer'],
            [['branch_name', 'globalSearch', 'companies_company_id' , 'branch_address', 'branch_status'], 'safe'],
        ];
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
        $query = Branches::find();

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

        $query->joinWith('companiesCompany');

        $dataProvider->setSort([
            'attributes' =>[
                'branch_name',
                'branch_status',
                'branch_address',
                'companies_company_id'=>[
                    'asc' => ['companies.company_name'=>SORT_ASC],
                    'desc' =>['companies.company_name'=>SORT_DESC],
                ]
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'branch_id' => $this->branch_id,
        ]);

        $query->orFilterWhere(['like', 'branch_name', $this->globalSearch])
            ->orFilterWhere(['like', 'branch_address', $this->globalSearch])
            ->orFilterWhere(['like', 'branch_status', $this->globalSearch])
            ->orFilterWhere(['like', 'companies.company_name', $this->globalSearch]);
            ;

        return $dataProvider;
    }
}
