<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property integer $clientId
 * @property string $location
 *
 * @property Client $client
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId'], 'integer'],
            [['location'], 'string', 'max' => 445]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clientId' => 'Client',
            'location' => 'Location',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'clientId']);
    }

    public static function getListOptions($clientId = null)
    {
        $data = array();
        $data[] = ['' => '...'];
        $data[] = \yii\helpers\ArrayHelper::map(self::findBySQL('SELECT id, location FROM address WHERE clientId=:clientId ORDER BY clientId', [':clientId'=> $clientId])->all(), 'id', 'location');
        return $data;
    }
}
