<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $reference
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Order[] $orders
 * @property Addresses[] $addresses
 */
class Client extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => 'updatedAt',
                ],
                'value' => function() {
                        return date('Y-m-d H:i:s');
                }
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['name', 'phone'], 'string', 'max' => 45],
            [['reference'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'reference' => 'Reference',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['clientId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['clientId' => 'id']);
    }


    public static function getListOptions()
    {
        $data = array();
        $data[] = ['' => '...'];
        $data[] = \yii\helpers\ArrayHelper::map(self::findBySQL('SELECT id, CONCAT(name," - ", phone) AS name FROM client ORDER BY name')->all(),'id','name');
        return $data;
    }

    /**
     * @return int
     */
    public function getOrderCount()
    {
        return \app\models\Order::find()->where(
            [
                'clientId' => $this->id
            ]
        )->count();
    }
}