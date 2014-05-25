<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $clientId
 * @property string $status
 * @property string $description
 * @property integer $driverId
 * @property string $address
 * @property string $total
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Driver $driver
 * @property Client $client
 */
class Order extends \yii\db\ActiveRecord
{

    const STATUS_PENDING = 'pending';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_REFUSED = 'refused';
    const STATUS_CANCELLED = 'cancelled';

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
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'total', 'eta'], 'required'],
            [['clientId', 'driverId', 'eta'], 'integer'],
            [['status', 'address'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['description'], 'string', 'max' => 2000],
            [['total'], 'string', 'max' => 45]
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
            'address' => 'Address',
            'status' => 'Status',
            'description' => 'Description',
            'driverId' => 'Driver',
            'eta' => 'Estimated Time (minutes)',
            'total' => 'Total',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driverId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'clientId']);
    }

    /**
     * Get totals
     * @param $status
     * @param $dateStart
     * @param $dateEnd
     *
     * @return float
     */
    public static function getTotal($status, $dateStart, $dateEnd){
        $sql = "SELECT SUM(TOTAL) FROM `order` WHERE STATUS=:status AND createdAt>=:dateStart AND createdAt<:dateEnd;";
        $command = \Yii::$app->db->createCommand($sql, [
            ':status' => $status,
            ':dateStart' => $dateStart,
            ':dateEnd' => $dateEnd
        ]);
        return (float) $command->queryScalar();
    }

    public static function getListOptions()
    {
        $data = array(
            self::STATUS_PENDING => 'PENDING',
            self::STATUS_DELIVERED => 'DELIVERED',
            self::STATUS_REFUSED => 'REFUSED',
            self::STATUS_CANCELLED => 'CANCELLED',
        );
        return $data;
    }
}