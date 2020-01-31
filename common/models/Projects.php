<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $name название проетка
 * @property int|null $parent_id указатель на родительский проект
 * @property int $create_user_id указатель на пользователя создашего доску
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Users $createUser
 * @property Projects $parent
 * @property Projects[] $projects
 * @property Tasks[] $tasks
 */
class Projects extends \yii\db\ActiveRecord implements Linkable
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'create_user_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['create_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['create_user_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'parent_id' => Yii::t('app', 'Parent ID'),
            'create_user_id' => Yii::t('app', 'Create User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'create_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Projects::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Projects::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['project_id' => 'id']);
    }


    public function fields()
    {
        return array_merge( parent::fields(), [ 'parent' ]);
    }

    public function extraFields()
    {
        return [
            'createUser',
        ];
    }

    public function getLinks()
    {
        $links = [
            Link::REL_SELF => Url::to(['tasks/view', 'id' => $this->id]),
            'createUser' => Url::to(['user/view', 'id' => $this->create_user_id])
        ];

        if ( $this->parent_id ) {
            $links['parent'] = Url::to(['projects/view', 'id' => $this->parent_id ]);
        }

        return $links;
    }
}
