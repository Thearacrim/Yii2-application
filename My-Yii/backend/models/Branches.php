<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property int $branch_id
 * @property int|null $companies_company_id
 * @property string|null $branch_name
 * @property string|null $branch_address
 * @property string|null $branch_status
 *
 * @property Companies $companiesCompany
 * @property Departments[] $departments
 */
class Branches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['companies_company_id','branch_status','branch_name','branch_address'],'required'],
            [['companies_company_id'], 'integer'],
            [['branch_status'], 'string'],
            [['branch_name', 'branch_address'], 'string', 'max' => 100],
            [['companies_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['companies_company_id' => 'company_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'companies_company_id' => 'Companies Company Name',
            'branch_name' => 'Branch Name',
            'branch_address' => 'Branch Address',
            'branch_status' => 'Branch Status',
        ];
    }

    /**
     * Gets query for [[CompaniesCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompaniesCompany()
    {
        return $this->hasOne(Companies::className(), ['company_id' => 'companies_company_id']);
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['branches_branch_id' => 'branch_id']);
    }
}
