<?php

namespace backend\modules\product\controllers;

use backend\models\Attr;
use backend\models\Brand;
use backend\models\CategoryAttr;
use backend\modules\product\models\forms\ProductForm;
use backend\modules\product\models\forms\ProductPropertiesForm;
use Yii;
use backend\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Category;
use yii\web\Response;

/**
 * ManageController implements the CRUD actions for Product model.
 */
class ManageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductForm();
        $parentCategories = Category::getParentCategoriesAsArray();

        $firstMainCategoryId = Category::getFirstMainCategoryId();
        $subCategory = Category::getSubcategoriesByCategoryId($firstMainCategoryId);
        $parentProduct = Product::getParentProductsAsArray();
        $brands = Brand::getAllBrands();

//        if ($model->load(Yii::$app->request->post())){
//            echo "<pre>";
//            print_r($model);
//            echo "</pre>";die;
//        }

        if ($model->load(Yii::$app->request->post()) && $productId = $model->save()) {
            return $this->redirect(['view', 'id' => $productId]);
        }

        return $this->render('create', [
            'model' => $model,
            'parentCategories' => $parentCategories,
            'subCategory' => $subCategory,
            'parentProduct' => $parentProduct,
            'brands' => $brands,
        ]);
    }

    public function actionSetProductProperties($id)
    {
        $model = new ProductPropertiesForm();

        $product = $this->findModel($id);
        $productAttrs = $product->getAttrs();
        $model->loadPropertiesData($productAttrs);

        if ($model->load(Yii::$app->request->post()) && $productId = $model->save()) {
            return $this->redirect(['view', 'id' => $productId]);
        }

        return $this->render('set-product-properties', [
            'model' => $model,
            'productAttrs' => $productAttrs,
            'productId' => $product->id,
            'productTitle' => $product->brand->title .' '. $product->title,
        ]);
    }

    public function actionGetSubcategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $mainCategoryId = Yii::$app->request->post('mainCategoryId');
        $subCategoryId = Yii::$app->request->post('subCategoryId');
        $productId = Yii::$app->request->post('productId');

        $subCategory = Category::getSubcategoriesByCategoryId($mainCategoryId);

        if (isset($productId) && isset($subCategoryId)) {
            $product = $this->findModel($productId);
            $productAttrs = $product->getAttrsAsArray();
            $categoryAttrs = CategoryAttr::getAttrsByCategoryId($subCategoryId);
            return [
                'success' => true,
                'productAttrs' => $productAttrs,
                'categoryAttrs' => $categoryAttrs,
            ];
        }

        if (isset($subCategoryId)) {
            $categoryAttrs = CategoryAttr::getAttrsByCategoryId($subCategoryId);
            return [
                'success' => true,
                'categoryAttrs' => $categoryAttrs,
            ];
        }

        if ($subCategory) {
            return [
                'success' => true,
                'subcategories' => $subCategory,
            ];
        }

        return [
            'success' => false,
        ];
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);
        $parentCategories = Category::getParentCategoriesAsArray();
        $subCategory = Category::getSubcategoriesByCategoryId($product->category->parent_id);
        $parentProduct = Product::getParentProductsAsArray();
        $brands = Brand::getAllBrands();
        
//        echo "<pre>";
//        print_r($product->getAttrsAsArray());
//        echo "</pre>";die;

        $model = new ProductForm();
        $model->loadProductData($product);



        if ($model->load(Yii::$app->request->post()) && $productId = $model->update($model->product_id)) {
            return $this->redirect(['view', 'id' => $productId]);
        }

        return $this->render('update', [
            'model' => $model,
            'parentCategories' => $parentCategories,
            'subCategory' => $subCategory,
            'parentProduct' => $parentProduct,
            'brands' => $brands,
            'product' => $product,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
