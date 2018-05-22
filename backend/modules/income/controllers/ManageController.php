<?php

namespace backend\modules\income\controllers;

use backend\models\Category;
use backend\models\Product;
use backend\models\Provider;
use backend\modules\income\models\forms\IncomeForm;
use backend\modules\income\models\forms\SetProductForm;
use Yii;
use backend\models\Income;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ManageController implements the CRUD actions for Income model.
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
     * Lists all Income models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Income::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Income model.
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
     * Creates a new Income model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IncomeForm();

        $providers = Provider::getProvidersAsArray();
        $incomeTitle = Income::getNewIncomeTitle();

        if ($model->load(Yii::$app->request->post()) && $incomeId = $model->save()) {
            return $this->redirect(['view', 'id' => $incomeId]);
        }

        return $this->render('create', [
            'model' => $model,
            'providers' => $providers,
            'incomeTitle' => $incomeTitle,
        ]);
    }


    public function actionSetProduct($id)
    {
        $model = new SetProductForm();

        $parentCategories = Category::getParentCategoriesAsArray();

        if ($model->load(Yii::$app->request->post()) && $incomeId = $model->save()) {
            return $this->redirect(['view', 'id' => $incomeId]);
        }

//        Yii::$app->assetManager->bundles = [
//            'yii\widgets\ActiveFormAsset' => false,
//            'yii\web\YiiAsset' => false,
//            'yii\bootstrap\BootstrapPluginAsset' => false,
//        ];

        return $this->render('set-product', [
            'model' => $model,
            'parentCategories' => $parentCategories,
        ]);
    }


    public function actionGetSubcategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $mainCategoryId = Yii::$app->request->post('mainCategoryId');
        $subCategoryId = Yii::$app->request->post('subCategoryId');
        $productsArr = Yii::$app->request->post('productsArr');

        if (isset($mainCategoryId)) {
            $subCategory = Category::getSubcategoriesByCategoryId($mainCategoryId);
            return [
                'success' => true,
                'subcategories' => $subCategory,
            ];
        }

        if (isset($subCategoryId)) {
            $products = Product::getProductsByCategoryId($subCategoryId, $productsArr);
            return [
                'success' => true,
                'products' => $products,
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function actionGetMaincategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $parentCategories = Category::getParentCategoriesAsArray();

        if (isset($parentCategories)) {
            return [
                'success' => true,
                'parentCategories' => $parentCategories,
            ];
        }

        return [
            'success' => false,
        ];
    }


    /**
     * Updates an existing Income model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Income model.
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
     * Finds the Income model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Income the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Income::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
