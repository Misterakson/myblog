<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\web\UploadedFile;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $date
 * @property integer $user_id
 * @property string $image
 *
 * @property Users $user
 */
class Posts extends \yii\db\ActiveRecord
{


    public $string;
    public $img;
    public $filename;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'text'], 'required'],
            ['date', 'default', 'value' => date('Y-m-d h:i:s') ],
            ['user_id', 'default', 'value' => Yii::$app->user->id],
            [['user_id'], 'integer'],
            [['image'],'file'],
            [['title', 'description'], 'string', 'max' => 255],
            [['text'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'text' => 'Пост',
            'date' => 'Date',
            'user_id' => 'User ID',
            'image' => 'Картинка'
        ];
    }




    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord)
        {
            $this->string = 'img_'.Yii::$app->security->generateRandomString();
            $this->img = UploadedFile::getInstance($this, 'image');
            $this->filename = 'images/'.$this->string.'.'.$this->img->extension;
            $this->img->saveAs($this->filename);
            $this->image = '/'.$this->filename;
        }
        else
        {
            $this->image = UploadedFile::getInstance($this,'images');
            if($this->image)
            {
                $this->image->saveAs(substr($this->image, 1));
            }
        }

        return parent::beforeSave($insert);
    }


    public function checkPost($id)
    {

        $owner = self::findAll([
            'user_id' => Yii::$app->user->id,
            'id' => $id
        ]);
        if(empty($owner))
        {
            return false;
        }
        return true;
    }


}
