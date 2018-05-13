<?php
namespace backend\modules\product\models\forms;
use backend\models\Product;
use backend\models\ProductAttrVal;
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
class ProductPropertiesForm extends Model
{
    public $prop = [];
    public $propDefaultVals = [];

    public function rules()
    {
        return [
            [['prop'], 'validateProp'],
//            [['prop'], 'each', 'rule' => [
//                'validateProp',
//                'params' => (isset($_POST['ProductPropertiesForm'])) ? $_POST['ProductPropertiesForm']['prop'] : ""]],
            [['propDefaultVals'], 'each', 'rule' => ['integer']],
        ];
    }


    public function save()
    {
        if ($this->validate()) {
            foreach ($this->prop as $key => $value) {
                $productAttrVal = ProductAttrVal::findOne($key);
                $productAttrVal->val = $value;
                $productAttrVal->save(false);
            }
            foreach ($this->propDefaultVals as $key => $value) {
                $productAttrVal = ProductAttrVal::findOne($key);
                $productAttrVal->attr_val_id = $value;
                $productAttrVal->save(false);
            }
            return $productAttrVal->product_id;
        }
    }

//    public function validateProp($attr, $params)
//    {
//        $id = array_search ($this->prop,$params);
//
//        $attrTitle = ProductAttrVal::findOne($id)->attr->title;
//        $attrType = ProductAttrVal::findOne($id)->attr->type;
//
//        if (!preg_match(Yii::$app->params['attrTypePattern'][$attrType],$this->prop)) {
//            $this->addError($attr, "$attrTitle must be an $attrType");
//        }
//    }

    public function validateProp($attr, $params)
    {
        foreach ($this->prop as $key => $value) {
            $attrTitle = ProductAttrVal::findOne($key)->attr->title;
            $attrType = ProductAttrVal::findOne($key)->attr->type;

            if (!preg_match(Yii::$app->params['attrTypePattern'][$attrType],$value)) {
                $this->addError($attr, "$attrTitle must be an $attrType");
            }
        }
    }


    public function loadPropertiesData($product)
    {
        foreach ($product as $prop) {
            $this->prop[$prop->id] = (isset($prop->val)) ? $prop->val : $prop->attr_val_id;
        }

    }
}