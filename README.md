# Yii2-blog


./yii migrate --migrationPath=@vendor/developer-av/yii2-blog/migrations

ln -s /home/alex/git/ecso-template-test/frontend/web/upload/ /home/alex/git/ecso-template-test/backend/web/upload

--frontend
public $userModel = '\common\models\User'; // User model
public $userField = 'username'; // Field of user model

--backend
public $userModel = '\common\models\User'; // User model
public $userField = 'username'; // Field of user model


'modules' => [
        ...
        'blog' => [
            'class' => 'developerav\blog\frontend\Module',
            'viewPath' => '@app/views', // custom views
        ],
    ],