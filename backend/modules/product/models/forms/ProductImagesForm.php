<?php
namespace backend\modules\product\models\forms;
use backend\models\Product;
use backend\models\ProductAttrVal;
use backend\models\ProductImage;
use phpDocumentor\Reflection\Types\Null_;
use Yii;
use backend\models\Attr;
use backend\models\CategoryAttr;
use yii\base\Model;
use yii\helpers\ArrayHelper;
/**
 * Created by PhpStorm.
 * User: us10140
 * Date: 23.04.2018
 * Time: 11:59
 */
class ProductImagesForm extends Model
{
    public $images;
    public $isMain;
    public $productId;

    public function rules()
    {
        return [
            [['images'], 'file',
//                'skipOnEmpty' => false,
                'extensions' => 'png, jpg',
                'maxFiles' => 4
            ],
            [['isMain'], 'each', 'rule' => ['integer']]
//            [['isMain'], 'integer']
        ];
    }

    public function __construct($productId, array $config = [])
    {
        $this->productId = $productId;
        parent::__construct($config);
    }


    public function save()
    {
        if ($this->validate()) {
            if (is_array($this->isMain)) {
                foreach ($this->isMain as $item) {
                    if ($item > 0) {
                        $productImage = ProductImage::findOne([
                            'product_id' => $this->productId,
                            'is_main' => 1,
                        ]);

                        if ($productImage) {
                            $productImage->is_main = null;
                            $productImage->save();
                            unset($productImage);
                        }

                        $productImage = ProductImage::findOne($item);
                        $productImage->is_main = 1;
                        $productImage->save();
                        unset($productImage);
                        break;
                    }
                }
            }

            foreach ($this->images as $image) {
                $productImage = ProductImage::findOne([
                    'product_id' => $this->productId,
                    'image' => Yii::$app->storage->getFilename($image),
                ]);

                if (!$productImage) {
                    $productImage = new ProductImage();
                    $productImage->product_id = $this->productId;
                    $productImage->image = Yii::$app->storage->saveUploadedFile($image);
                    $productImage->save();
                }
            }
            return $this->productId;
        }
    }
}