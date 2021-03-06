<?php

/* @var $this \yii\web\View */
/* @var $content string */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LayoutAsset;
use common\assets\AppAsset;
use common\models\ProductCategory;
use yii\helpers\Url;
use yii\helpers\Json;

LayoutAsset::register($this);
AppAsset::register($this);

$categorys = ProductCategory::getAllCategorys('all');

$request_cookies = Yii::$app->request->cookies;
$cart = 0;
if (isset($request_cookies['cart'])) {
    $cart_cookie = Json::decode($request_cookies['cart']->value);
    foreach($cart_cookie as $product)
    {
        $cart += $product['quantity'];
    }
}
$facebook_pixel = Yii::$app->settings->get('facebook_pixel');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?= $facebook_pixel ?>');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=154822101884046&ev=PageView&noscript=1"/></noscript>
    <!-- End Facebook Pixel Code -->

</head>
<body>
<?php $this->beginBody() ?>
<div id="fb-root"></div>
<script async defer src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=351395171884559&autoLogAppEvents=1"></script>

<header class="header">
    <div class="container-fluid fluid-newpad">
        <?= Html::a("<span>".Yii::$app->name."</span>", Url::home(), ['class' => "header-logo"]) ?>
        <div class="header-button">
            <button class="btn-link">
                <i class="fa fa-bars"></i>
                <span>Browse</span>
            </button>
        </div>
        <div class="header-search">
            <form method="get" action="">
                <div class="input-group search-content">
                    <input id="search-query" type="text" class="form-control" name="search-query" placeholder="Search for items">
                    <span class="input-group-addon">Search</span>
                </div>
            </form>
        </div>
        <div class="header-customer" >
            <?php  if(Yii::$app->user->isGuest){ ?>
                <?= Html::a('Login', Url::to(['/user/auth/login'])) ?>
            <?php } else {?>
                <a class="dropdown-toggle dropdown_web" data-toggle="dropdown" href="#"><?= Yii::$app->user->identity->username ?> <span class="caret"></span></a>
                <a class="dropdown-toggle dropdown_mobile" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?= Url::to(['/admin/dashboard/dashboard']) ?>"> Admin</a></li>
                    <li>
                        <?php
                        echo Html::beginForm(Url::to(['/user/auth/logout']), 'post');
                        echo Html::submitButton(
                            'Logout',
                            ['class' => 'btn-logout']
                        );
                        echo Html::endForm();
                        ?>
                    </li>
                </ul>
            <?php }?>
            &nbsp;
            <a class="cart_container" href="<?= Url::to('/pub/cart/index') ?>">
                <i class="fa fa-shopping-cart cart_container">
                    <span class="cart_num" ><?= $cart ?></span>
                </i>
                <span>Cart</span>
            </a>
        </div>
    </div>
</header>

<div class="menu-hor">
    <div class="container-fluid fluid-newpad">
        <nav class="hor-container">
            <?php foreach($categorys as $categoryid => $category): ?>
                <?= Html::a($category->name, Url::to(['/pub/product/index', 'category_id' => $categoryid])) ?>
            <?php endforeach ?>
        </nav>
    </div>
</div>

<div class="menu-ver">
    <div class="ver-container" >
        <div class="ver-header">
            <div>
                <span><?= Yii::$app->name ?></span>
                <button class="btn-link">&#10006;</button>
            </div>
            <div>
                <p>BROWSE CATEGORIES</p>
            </div>
        </div>

        <div class="ver-body">
            <div class="ver-content">
                <?php foreach($categorys as $categoryid => $category): ?>
                    <?= Html::a($category->name, Url::to(['/pub/product/index', 'category_id' => $categoryid])) ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid fluid-newpad">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid fluid-newpad">
        <div class="pull-left">
            <?= Yii::$app->name ?>
            <div class="fb-like" data-href="https://www.facebook.com/rchobbypage/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
        </div>
        <div class="pull-right">&copy; ngocdatbk <?= date('Y') ?></div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
