<?php
namespace app\admin\controller;
use app\admin\model\File as Files;

class File extends Home{

    /**
     * 普通单图上传
     * @param   string  $file_name  FILES传入的字段名
     * @return  array               状态及文件地址
     */
    public function imgUpload($file_name='file'){
        $file = $this->file($file_name);
        
        // return array('status'=>1,'Msg'=>'/Uploads/Image/20200903\45a1d7f1c9aa93eb9f7f505466106a48.jpg','id'=>7);
        
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $root_path = '/Uploads/Image/';
            $info = $file->move(ROOT_PATH.$root_path);
            
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                // echo $info->getExtension().'<br/>';
                // // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                // echo $info->getSaveName().'<br/>';
                // // 输出 42a79759f284b767dfcb2a0197904287.jpg
                // echo $info->getFilename().'<br/>'; 
                $path = $root_path.str_replace('\\','/',$info->getSaveName());
                // var_dump($info->getSaveName(),$path);die;

                if(isset($file_id['file_id'])){
                    $data = array(
                        'id'    => $file_id['file_id'],
                        'crop'  => $path,
                    );
                }else{
                    $data = array(
                        'name'      =>  $file->getinfo()['name'],
                        'type'      =>  $info->getExtension(),
                        'size'      =>  $file->getinfo()['size'],
                        'path_name' =>  $path,
                        'md5'       =>  $info->md5(),
                        'sha1'      =>  $info->sha1(),
                    );
                }
                $id = (new Files())->addFile($data);
                
                if($id){
                    return array('status'=>1,'Msg'=>$root_path.str_replace('\\','/',$info->getSaveName()),'id'=>$id);
                }else{
                    return array('status'=>0,'Msg'=>'数据写入失败!');
                }
                

            }else{
                // 上传失败获取错误信息
                return array('status'=>0,'Msg'=>$file->getError());
            }
        }
    }
    
    /**
     * 普通文档上传
     * @param   string  $file_name  FILES传入的字段名
     * @return  array               状态及文件地址
     */
    public function fileUpload($file_name='file'){
        $file = $this->file($file_name);

        // return array('status'=>1,'Msg'=>'/Uploads/Document/20200629\1e3b59fa6f08ed410b991ce970b5c012.doc','id'=>1);
        // var_dump($file->getinfo());
        // die;

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            if(in_array($file->getinfo()['type'],array('image/jpeg','image/jpg','image/png','image/gif'))){
                return array('status'=>-1,'Msg'=>'请上传文档格式文件!');
            }
            
            $root_path = '/Uploads/File/';
            $info = $file->move(ROOT_PATH.$root_path);
            if($info){
                $path = $root_path.str_replace('\\','/',$info->getSaveName());
                $data = array(
                    'name'          =>  $file->getinfo()['name'],
                    'type'          =>  $info->getExtension(),
                    'size'          =>  $file->getinfo()['size'],
                    'path_name'     =>  $path,
                    'md5'           =>  $info->md5(),
                    'sha1'          =>  $info->sha1(),
                );

                $id = (new Files())->addFile($data);
                
                if($id){
                    return array('status'=>1,'Msg'=>$root_path.str_replace('\\','/',$info->getSaveName()),'id'=>$id);
                    
                }else{
                    return array('status'=>0,'Msg'=>'数据写入失败!');
                }
                

            }else{
                // 上传失败获取错误信息
                return array('status'=>0,'Msg'=>$file->getError());
            }
            
        }
    }


}