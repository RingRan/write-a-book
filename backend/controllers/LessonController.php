<?php

namespace backend\controllers;

use common\models\Chapter;

use yii\data\Pagination;

use Yii;
use common\models\Lesson;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LessonController implements the CRUD actions for Lesson model.
 */
class LessonController extends Controller
{
	public $layout = "lte_main";
	
	/**
	 * Lists all Lesson models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$query = Lesson::find();
		$querys = Yii::$app->request->get('query');
		$chapterId = Yii::$app->request->get('chapterId');
		$chapter = Chapter::findOne($chapterId);
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
				'pageSizeParam'=>'per-page'
			]);
		$models = $query
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
		
		return $this->render('index', [
				'models'=>$models,
				'pages'=>$pagination,
				'query'=>$querys,
				'chapterId'=>$chapterId,
				'chapter'=>$chapter
			]);
	}
	
	/**
	 * Displays a single Lesson model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);
		echo json_encode($model->getAttributes());
	}
	
	/**
	 * Creates a new Lesson model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Lesson();
	
		if ($model->load(Yii::$app->request->post())) {
			 
			$model->created_at = date('Y-m-d H:i:s');
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
	 * Updates an existing Lesson model.
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
			}else{
				$msg = array('errno'=>2, 'data'=>$model->getErrors());
				echo json_encode($msg);
			}
		} else {
			$msg = array('errno'=>2, 'msg'=>'数据出错');
			echo json_encode($msg);
		}
	}
	
	/**
	 * Deletes an existing Lesson model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete(array $ids)
	{
		if(count($ids) > 0){
			$c = Lesson::deleteAll(['in', 'id', $ids]);
			echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
		}else{
			echo json_encode(array('errno'=>2, 'msg'=>'参数错误'));
		}
	}
	
	/**
	 * Finds the Lesson model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Lesson the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Lesson::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
