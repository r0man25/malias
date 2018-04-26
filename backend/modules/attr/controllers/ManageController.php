<?php

namespace backend\modules\attr\controllers;

use backend\models\Category;
use backend\modules\attr\models\forms\AttrForm;
use Yii;
use backend\models\Attr;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ManageController implements the CRUD actions for Attr model.
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
     * Lists all Attr models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Attr::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Attr model.
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
     * Creates a new Attr model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AttrForm();

        $parentCategories = Category::getParentCategoriesAsArray();


//        if ($model->load(Yii::$app->request->post())){
//            echo "<pre>";
//            var_dump($model);
//            echo "</pre>";die;
//        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'parentCategories' => $parentCategories,
        ]);
    }

    /**
     * Updates an existing Attr model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $attr = $this->findModel($id);

        echo "<pre>";
        print_r($attr->getMainCategory());
        echo "</pre>";die;

        $model = new AttrForm();

        $parentCategories = Category::getParentCategoriesAsArray();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'parentCategories' => $parentCategories,
        ]);
    }

    public function actionGetSubcategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $isChecked = Yii::$app->request->post('isChecked');
        $id = Yii::$app->request->post('id');

        $subCategory = Category::getSubcategoriesByCategoryId($id);
        $parentAttrs = Attr::getMainAttrByCategoryId(array_flip ($subCategory));

        if ($isChecked === "true" && $subCategory) {
            return [
                'success' => true,
                'isChecked' => true,
                'subcategories' => $subCategory,
            ];
        }

        if ($isChecked === "false" && $subCategory) {
            return [
                'success' => true,
                'isChecked' => false,
                'subcategories' => $subCategory,
                'parentAttrs' => $parentAttrs,
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function actionGetMainAttr()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $isChecked = Yii::$app->request->post('isChecked');
        $id = Yii::$app->request->post('id');
        $parentAttrs = Attr::getMainAttrByCategoryId($id);

        if ($isChecked === "true" && $parentAttrs) {
            return [
                'success' => true,
                'isChecked' => true,
                'parentAttrs' => $parentAttrs,
            ];
        }

        if ($isChecked === "false" && $parentAttrs) {
            return [
                'success' => true,
                'isChecked' => false,
                'parentAttrs' => $parentAttrs,
            ];
        }

        return [
            'success' => false,
        ];
    }

    /**
     * Deletes an existing Attr model.
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
     * Finds the Attr model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attr the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attr::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
