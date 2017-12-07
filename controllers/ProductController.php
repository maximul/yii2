<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 16.11.2017
 * Time: 18:08
 */

namespace app\controllers;


use app\models\Product;
use Yii;

class ProductController extends AppController
{
    public function actionView($id)
    {
//        $id = Yii::$app->request->get('id');
//        $product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one();
        $product = Product::findOne($id);
        if (empty($product))
            throw new \yii\web\HttpException(404, 'Такого товара нет.');
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->keywords, $product->description);
        return $this->render('view', compact('product', 'hits'));
    }
}