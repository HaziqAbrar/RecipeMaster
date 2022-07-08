<?php

namespace common\models;
use yii\helpers\FileHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\imagine\image;
use Imagine\Image\Box;


use Yii;

/**
 * This is the model class for table "{{%recipe}}".
 *
 * @property string $recipe_id
 * @property string $name
 * @property string|null $description
 * @property string|null $tags
 * @property int|null $average_cost
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Recipe extends \yii\db\ActiveRecord
{
    const STATUS_UNLISTED = 0;
    const STATUS_PUBLISHED = 1;
    
    /**
     * @var \yii\web\UploadedFile
     */
    public $recipe;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%recipe}}';
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false,
                ]
            ];
        }
        
        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                [['recipe_id', 'name'], 'required'],
                [['description'], 'string'],
                [['average_cost', 'status', 'created_at', 'updated_at', 'created_by'], 'integer'],
                [['recipe_id'], 'string', 'max' => 16],
                [['name', 'tags'], 'string', 'max' => 512],
                [['recipe_id'], 'unique'],
                [['status'], 'default', 'value' => self::STATUS_UNLISTED],
                [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'recipe_id' => 'Recipe ID',
            'name' => 'Name',
            'description' => 'Description',
            'tags' => 'Tags',
            'average_cost' => 'Average Cost',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }
    
    public function getStatusLabels()
    {
        return [
            self::STATUS_UNLISTED => 'Unlisted',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }
    
    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    /**
     * {@inheritdoc}
     * @return \common\models\query\RecipeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RecipeQuery(get_called_class());
    }

    public function save($runValidaiton = true, $attributeNames = null)
    {
        $isInsert = $this->isNewRecord;
        if ($isInsert) {
            $this->recipe_id = Yii::$app->security->generateRandomString(16);
            $this->name = $this->recipe->name;
        }
        $saved = parent::save($runValidaiton, $attributeNames);
        if (!$saved) {
            return false;
        }
        if ($isInsert) {
            $recipePath = Yii::getAlias('@frontend/web/storage/thumbnail/' . $this->recipe_id . '.jpg');
            if (!is_dir(dirname($recipePath))) {
                FileHelper::createDirectory(dirname($recipePath));
            }
            $newWidth = 400;
            $newHeight = 400;
            $this->recipe->saveAs($recipePath);
            Image::getImagine()
                ->open($recipePath)
                ->thumbnail(new Box($newWidth, $newHeight))
                ->save();        
            }

        return true;
    }

    public function getThumbnailLink()
    {
        return Yii::$app->params['frontendUrl'] . 'storage/thumbnail/' . $this->recipe_id . '.jpg' ;
    }
    
    public function afterDelete()
    {
        parent::afterDelete();

        $recipePath = Yii::getAlias('@frontend/web/storage/thumbnail/' . $this->recipe_id . '.jpg');
        if ($recipePath) {
            unlink($recipePath);
        }
    }
}
