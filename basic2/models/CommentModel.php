<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property string $username
 * @property int $post
 * @property string $content
 * @property string $date
 *
 * @property Post $post0
 * @property User $username0
 */
class CommentModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'post', 'content'], 'required'],
            [['post'], 'integer'],
            [['date'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['content'], 'string', 'max' => 200],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['username' => 'username']],
            [['post'], 'exist', 'skipOnError' => true, 'targetClass' => PostModel::class, 'targetAttribute' => ['post' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'post' => 'Post',
            'content' => '',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Post0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost0()
    {
        return $this->hasOne(Post::class, ['id' => 'post']);
    }

    /**
     * Gets query for [[Username0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::class, ['username' => 'username']);
    }
}
