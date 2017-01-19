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
            'id' => 'ID',
            'name' => 'Name',
            'place_type' => 'Place Type',
            'status' => 'Status',
            'google_place_id' => 'Google Place ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'slug' => 'Slug',
            'website' => 'Website',
            'full_address' => 'Full Address',
            'vicinity' => 'Vicinity',
            'notes' => 'Notes',
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
}
