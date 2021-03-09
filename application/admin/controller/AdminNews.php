<?php
namespace app\admin\controller;
use app\admin\model\AdminNews as AdminNewsModel;
use app\admin\validate\AdminNewsValidate;
use app\admin\model\Column as ColumnModel;
use think\Page;

class AdminNews extends Home{

    public function initialize(){
        // 登录态检测
        $this->is_login();
        
        // 权限检测
        $rule = $this->checkUrl();
        $this->assign('url',$this->url);
        
        if($rule){
            echo json_encode($rule);die;
        }
    }

    /**
     * 新闻栏目模块列表
     * @param   int     $data['column_id']     栏目id
     */
    public function newsList(){
        $data = $this->param();

        if(empty($data['column_id'])){
            $this->error('栏目参数有误');
        }
        $AdminNewsModel = new AdminNewsModel();
        $where[] = ['column_id','eq',$data['column_id']];
        $seach_val='';
        $param = '';
        $seach_condition_val = '';
        if($this->isGet() && !$this->isAjax() && !empty($data['seach'])){
            $param = '?seach='.$data['seach'];
            $seach = explode("&",base64_decode(trim($data['seach'])));
            $seach_num = count($seach);
            for($i=0; $i<$seach_num; $i++){
                $seach_val[] = explode("=",trim($seach[$i]));
            }
            foreach($seach_val as $k =>$val){
                if($val[1] || $val[1]==='0'){
                    switch($val[0]){
                        case "title":
                            $where[] = array($val[0],'like',"%{$val[1]}%");
                            break;
                        default:
                            $where[] = array($val[0],'eq',$val[1]);
                            break;
                    }
                    $seach_condition_val[$val[0]] = $val[1];
                }
            }
        }

       
        $data['p'] = !empty($data['p'])? $data['p']:1;
        $listRows = 20;

        $list = $AdminNewsModel->getPage($where,true,'sort desc,id desc',$data['p'],$listRows);
        $total = $AdminNewsModel->where($where)->count();
        // 1.当前页数据,2.路由,3.总记录数,4.每页记录数,5.页码
        $page = new Page($list,$this->url,$total,$listRows,$data['p'],$param);

        $this->assign('seach',$seach_condition_val);
        $this->assign('list',$list);
        $this->assign('page',$page);

        $this->templateLocation(!empty($data['column_id'])?$data['column_id']:'');
        return $this->fetch($this->url);
    }

    /**
     * 新增新闻模块数据
     * @param   int     $data['column_id']     栏目Id
     */
    public function newsAdd(){
        $data = $this->param();
        
        if($this->isAjax()){
            $result['status'] = 0;
            // 数据验证
            $validate = new AdminNewsValidate();
            if(!$validate->scene('add')->check($data)){
                $result['Msg'] = $validate->getError();
            }else{
                $cate = (new ColumnModel())->getColumn(array('id'=>$data['column_id']));
                // 获取文本内容中的部分文字内容
                $data['description']? '':$data['description'] = getContentStr($data['content'],150);
                if(!empty($data['id'])){$type='编辑';}else{$type='新增';}
                // 新增新闻模块数据
                $Nickname = session('Nickname');
                $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}{$type}【{$cate[0]['title']}】-【{$data['title']}】");
                $result = $this->addUpdate(new AdminNewsModel(),'addAdminNews', $logArtion ,$data,$type);
            }
            return json($result);
        }else{
            if(!empty($data['id'])){
                $info = (new AdminNewsModel)->getAdminNews(array('id'=>$data['id']));
                if(empty($info[0])){
                    $this->errro('未站到该数据');
                }else{
                    $this->assign('info',$info[0]);
                }
            }
            $this->templateLocation(!empty($data['column_id'])?$data['column_id']:'');
            return $this->fetch($this->url);
        }
    }

    /**
     * 设置数据状态 (禁用|启用)
     */
    public function newsSetStatus(){
        $data = $this->param();

        $result['status'] = 0;
        if(!array_key_exists('status',$data) || empty($data['id'])){
            $result['Msg'] = '参数错误 #1';
            return json($result);
        }
       
        switch($data['status']){
            case "1":
                $hint = '启用';
                break;
            case "3":
                $hint = '禁用';
                break;
            default:
                $hint = '';
                $result['Msg'] = '状态参数错误 #2';
                return json($result);
        }

        $save['id'] = $data['id'];
        $save['status'] = $data['status'];
        if((new AdminNewsModel)->addAdminNews($save)){
            $result['status'] = 1;
            $result['Msg'] = "{$hint}成功";
        }else{
            $result['Msg'] = "{$hint}失败";
        }
        return json($result);
    }

    /**
     * 设置数据状态 (禁用|启用)
     */
    public function newsDel(){
        $data = $this->param();
        $result['status'] = 0;

        if(empty($data['id'])){
            $result['Msg'] = 'Id参数错误 #1';
            return json($result);
        }
        
        // $where_del = array('id'=>$data['id']);
        // if((new AdminNewsModel)->deleteAdminNews($where_del)){
        //     $result['status'] = 1;
        //     $result['Msg'] = "删除成功";
        // }else{
        //     $result['Msg'] = "删除失败";
        // }
        $result['status'] = 1;
            $result['Msg'] = "删除成功";
        return json($result);
    }
}