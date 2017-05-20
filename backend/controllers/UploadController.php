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
      $img = $_POST['top'];
      if(!$img){
        echo "no fileToUpload index";
        exit();
      }

      $start=strpos($img,',');
      $img= substr($img,$start+1);
      $img = str_replace(' ', '+', $img);
      $data = base64_decode($img);
      $fileName = './upload/'. uniqid() . '.png';
      $success = file_put_contents($fileName, $data);
      $data=array();
      if($success){
          $data['status']=1;
          $data['msg']='上传成功';
          echo json_encode($data);
      }else{
          $data['status']=0;
          $data['msg']='系统繁忙，请售后再试';
          echo json_encode($data);
      }
      // $upload_file_temp = $uf['tmp_name'];
      // // $upload_file_name = $uf['name'];
      // $upload_file_name = 'qr_bg.jpg';
      //
      // if(!$upload_file_temp){
      //   print_r($uf);
      //   echo "上传失败";
      //   exit();
      // }
      //
      // $file_size_max = 1024*1024;// 1M限制文件上传最大容量(bytes)
      // // 检查文件大小
      // if ($uf['size'] > $file_size_max) {
      //   echo "对不起，你的文件容量超出允许范围：".$file_size_max;
      //   exit();
      // }
      // $store_dir = "./upload/";// 上传文件的储存位置
      // $accept_overwrite = 0;//是否允许覆盖相同文件
      // $file_path = $store_dir . $upload_file_name;
      // // 检查读写文件
      // if (!move_uploaded_file($upload_file_temp, $file_path)) {
      //   echo "复制文件失败".$upload_file_temp." to ". $file_path;
      //   exit;
      // }
      // // if (file_exists($file_path) && !$accept_overwrite) {
      // //   echo "存在相同文件名的文件";
      // //   exit();
      // // } else {
      // //   // 复制文件到指定目录
      // //
      // // }
      //
      // $error = $uf['error'];
      // switch($error) {
      //     case 0:
      //         $msg = 'ok';
      //         break;
      //     case 1:
      //         $msg = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值.';
      //         break;
      //     case 2:
      //         $msg = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。';
      //         break;
      //     case 3:
      //         $msg = '文件只有部分被上传';
      //         break;
      //     case 4:
      //         $msg = '没有文件被上传';
      //         break;
      // }
      //
      // return ['test' => $uf, 'path' => $file_path, 'msg' => $msg];
  }
}
