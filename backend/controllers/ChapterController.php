<?php

namespace backend\controllers;

use yii\data\Pagination;

use Yii;
use common\models\Chapter;
use common\models\ChapterQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChapterController implements the CRUD actions for Chapter model.
 */
class ChapterController extends Controller
{
	public $layout = "lte_main";

    /**
     * Lists all Chapter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Chapter::find();
        $querys = Yii::$app->request->get('query');
        $courseId = Yii::$app->request->get('courseId');
        if(count($querys) > 0){
            $condition = "";
            $parame = array();
            foreach($querys as $key=>$value){
                $value = trim($value);
                if(empty($value) == false){
                    $parame[":{$key}"]=$value;
                    if(empty($condition) == true){
                        $condition = " {$key}=:{$key} ";
                    }
                    else{
                        $condition = $condition . " AND {$key}=:{$key} ";
                    }
                }
            }
            if(count($parame) > 0){
                $query = $query->where($condition, $parame);
            }
        }
        //$models = $query->orderBy('display_order')
        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => '10', 
            'pageParam'=>'page', 
            'pageSizeParam'=>'per-page']
        );
        $models = $query
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
            'courseId'=>$courseId,
        ]);
    }

    /**
     * Displays a single Chapter model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());
    }

    /**
     * Creates a new Chapter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chapter();
        
        if ($model->load(Yii::$app->request->post()) ) {
        	$model->status = Chapter::STATUS_PREPARING;
        	$model->created_at = date('Y-m-d H:i:s');
        	$model->updated_at = date('Y-m-d H:i:s');
        	$model->level = Chapter::LEVEL_FIRST;
	        if($model->validate() == true && $model->save()){
	        		$msg = array('errno'=>0, 'msg'=>'保存成功');
	        		echo json_encode($msg);
	        } else{
	        		$msg = array('errno'=>2, 'data'=>$model->getErrors());
	        		echo json_encode($msg);
	        }
        } else {
            $msg = array('errno'=>2, 'msg'=>$model->getErrors());
            echo json_encode($msg);
        }
    }

    /**
     * Updates an existing Chapter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
    	$id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            
            $model->updated_at = date('Y-m-d H:i:s');        
        
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    }

    /**
     * Deletes an existing Chapter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
    	if(count($ids) > 0){
            $c = Chapter::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }else{
            echo json_encode(array('errno'=>2, 'msg'=>'参数错误'));
        }
    }

    /**
     * Finds the Chapter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Chapter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chapter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
