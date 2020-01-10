<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "boards".
 *
 * @property int $id
 * @property string $name название доски для задач ( как название проектов в jira )
 * @property int $create_user_id указатель на пользователя создашего доску
 * @property string|null $crate_datetime
 * @property string|null $update_datetime
 *
 * @property Users $createUser
 * @property Tasks[] $tasks
 */
class Boards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'boards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'create_user_id'], 'required'],
            [['create_user_id'], 'integer'],
            [['crate_datetime', 'update_datetime'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['create_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['create_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'create_user_id' => Yii::t('app', 'Create User ID'),
            'crate_datetime' => Yii::t('app', 'Crate Datetime'),
            'update_datetime' => Yii::t('app', 'Update Datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(Users::class, ['id' => 'create_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['board_id' => 'id']);
    }
}
