<?php

namespace app\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "place".
 *
 * @property integer $id
 * @property string $name
 * @property integer $place_type
 * @property integer $status
 * @property string $google_place_id
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $slug
 * @property string $website
 * @property string $full_address
 * @property string $vicinity
 * @property string $notes
 *
 * @property MeetingPlace[] $meetingPlaces
 * @property User $createdBy
 * @property UserPlace[] $userPlaces
 */
class Place extends \yii\db\ActiveRecord
{
    const TYPE_OTHER = 0;
    const TYPE_RESTAURANT = 10;
    const TYPE_COFFEESHOP = 20;
    const TYPE_RESIDENCE = 30;
    const TYPE_OFFICE = 40;
    const TYPE_BAR = 50;

    public $lat;
    public $lng;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'google_place_id', 'created_by', 'created_at', 'updated_at', 'slug', 'website', 'full_address', 'vicinity'], 'required'],
            [['place_type', 'status', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['notes'], 'string'],
            [['name', 'google_place_id', 'slug', 'website', 'full_address', 'vicinity'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'place_type' => Yii::t('app', 'Place Type'),
            'status' => Yii::t('app', 'Status'),
            'google_place_id' => Yii::t('app', 'Google Place ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'slug' => Yii::t('app', 'Slug'),
            'website' => Yii::t('app', 'Website'),
            'full_address' => Yii::t('app', 'Full Address'),
            'vicinity' => Yii::t('app', 'Vicinity'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingPlaces()
    {
        return $this->hasMany(MeetingPlace::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPlaces()
    {
        return $this->hasMany(UserPlace::className(), ['place_id' => 'id']);
    }

    public function getPlaceType($data) {
        $options = $this->getPlaceTypeOptions();
        return $options[$data];
    }

    public function getPlaceTypeOptions()
    {
        return array(
            self::TYPE_RESTAURANT => 'Restaurant',
            self::TYPE_COFFEESHOP => 'Coffeeshop',
            self::TYPE_RESIDENCE => 'Residence',
            self::TYPE_OFFICE => 'Office',
            self::TYPE_BAR => 'Bar',
            self::TYPE_OTHER => 'Other'
        );
    }

}
