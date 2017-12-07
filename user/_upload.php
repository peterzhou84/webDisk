<?php
    require_once '../lib/config.php';

    //1.接收提交文件的用户  
    $uid=$_COOKIE['uid'];  
  
    //判断是否上传成功（是否使用post方式上传）  
    if(is_uploaded_file($_FILES['file']['tmp_name'])) {  
        //把文件转存到你希望的目录（不要使用copy函数）  
        $uploaded_file=$_FILES['file']['tmp_name'];  
  
        //我们给每个用户动态的创建一个文件夹  
        $user_path=$_SERVER['DOCUMENT_ROOT']."/uploads/".$uid;  
        //判断该用户文件夹是否已经有这个文件夹  
        if(!file_exists($user_path)) {  
            mkdir($user_path);  
        }  
  
        // $file_true_name=iconv("UTF-8", "gb2312", $_FILES['file']['name']);
        $file_true_name=$_FILES['file']['name'];
        $move_to_file=$user_path."/".$file_true_name;  
        // $move_to_file=$user_path."/".substr($file_true_name,strrpos($file_true_name,"."));  
        //echo "$uploaded_file   $move_to_file";  
        if(move_uploaded_file($uploaded_file,$move_to_file)) {  
            global $db; 
            $db->insert('file',[
                'uid'=>$uid,
                'key'=>$file_true_name,
                'fsize'=>$_FILES['file']['size'],
                'putTime'=>time(),
                'mimeType'=>$_FILES['file']['type']
            ]);
            echo $_FILES['file']['name']."上传成功"; 
        } else {  
            echo "上传失败";  
        }  
    } else {  
        echo "上传失败";  
    }  