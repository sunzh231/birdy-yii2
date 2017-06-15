<?php
namespace backend\controllers;

use Yii;
use yii\web\UploadedFile;
use app\utils\Curl;

class UploadController extends BaseController
{
  public $modelClass = '';

  public $serializer = [
      'class' => 'yii\rest\Serializer',
      'collectionEnvelope' => 'items',
  ];

  public function actions()
  {
      $actions = parent::actions();
      // 注销系统自带的实现方法
      unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
      return $actions;
  }

  public function actionPicture()
  {
    // $img = $_POST['top'];
    // if(!$img){
    //   echo "no fileToUpload index";
    //   exit();
    // }
    //
    // $start=strpos($img,',');
    // $img= substr($img,$start+1);
    // $img = str_replace(' ', '+', $img);
    // $data = base64_decode($img);
    // $name = uniqid() . '.png';
    // $fileName = './upload/'. $name;
    // $success = file_put_contents($fileName, $data);
    // if ($success) {
    //   return ['code' => 0, 'msg' => '上传成功', 'data' => Yii::$app->params['domain'] .'upload/'. $name];
    // } else {
    //   return ['code' => -1, 'msg' => '上传失败'];
    // }
    $uf = $_FILES['file'];
    if(!$uf){
      $msg = "文件不存在";
      return [ 'code' => -1, 'msg' => $msg];
    }
    $upload_file_temp = $uf['tmp_name'];
    $upload_file_name = uniqid() . '.png';

    if (!$upload_file_temp) {
      $msg = "上传失败";
      return [ 'code' => -1, 'msg' => $msg];
    }

    $file_size_max = 1024*1024*5;// 1M限制文件上传最大容量(bytes)
    // 检查文件大小
    if ($uf['size'] > $file_size_max) {
      $msg = "对不起，你的文件容量超出允许范围：". $file_size_max;
      return [ 'code' => -1, 'msg' => $msg];
    }
    $store_dir = "./upload/";// 上传文件的储存位置
    $file_path = $store_dir . $upload_file_name;
    // 检查读写文件
    if (!move_uploaded_file($upload_file_temp, $file_path)) {
      $msg = "文件创建失败";
      return [ 'code' => -1, 'msg' => $msg];
    }
    return ['code' => 0, 'msg' => '上传成功', 'data' => Yii::$app->params['domain'] .'upload/'. $upload_file_name];
  }

  public function actionFile()
  {
    $uf = $_FILES['file'];
    if(!$uf){
      $msg = "文件不存在";
      return [ 'code' => -1, 'msg' => $msg];
    }
    $upload_file_temp = $uf['tmp_name'];
    $upload_file_name = uniqid() . '.png';

    if (!$upload_file_temp) {
      $msg = "上传失败";
      return [ 'code' => -1, 'msg' => $msg];
    }

    $file_size_max = 1024*1024;// 1M限制文件上传最大容量(bytes)
    // 检查文件大小
    if ($uf['size'] > $file_size_max) {
      $msg = "对不起，你的文件容量超出允许范围：". $file_size_max;
      return [ 'code' => -1, 'msg' => $msg];
    }
    $store_dir = "./upload/admin/";// 上传文件的储存位置
    $file_path = $store_dir . $upload_file_name;
    // 检查读写文件
    if (!move_uploaded_file($upload_file_temp, $file_path)) {
      $msg = "文件创建失败";
      return [ 'code' => -1, 'msg' => $msg];
    }

    $error = $uf['error'];
    switch($error) {
      case 0:
        $msg = 'ok';
        break;
      case 1:
        $msg = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值.';
        break;
      case 2:
        $msg = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。';
        break;
      case 3:
        $msg = '文件只有部分被上传';
        break;
      case 4:
        $msg = '没有文件被上传';
        break;
    }
    return [ 'code' => 0, 'name' => $upload_file_name, 'path' => Yii::$app->params['domain'] .'upload/admin/'. $upload_file_name, 'msg' => $msg];
  }
}
