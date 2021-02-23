<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://0731pgy.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wanglun <573075930@qq.com>
// +----------------------------------------------------------------------

namespace app\index\controller;
use app\boss\model\UserBoss;
use app\index\model\NoticeBoss;
use app\index\model\NoticeWorker;
use app\boss\model\ReleaseBoss;
use app\worker\model\UserWorker;
use app\boss\model\ContractBoss;
use app\worker\model\ContractWorker;
use app\index\model\MoneyWorker;
use think\Page;

/**
 * 平台管理端审核类
 */
class Audit extends Home{
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
     * 职业者账号审核列表
     * @param   int     $p          页数
     * @return  array   $list,$page 列表数据,翻页
     */
    public function workerAccountlist(){
        
        $data = $this->param();
        $UserWorker = new UserWorker();

        $where = '';
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
                        case "nickname":
                            $where[] = array($val[0],'like',"%{$val[1]}%");
                            break;
                        case "address":
                            $where[] = array($val[0],'like',"%{$val[1]}%");
                            break;
                        case "industry":
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

        $list = $UserWorker->getPage($where,true,'id desc',$data['p'],$listRows);
        $total = $UserWorker->where($where)->count();
        // 1.当前页数据,2.路由,3.总记录数,4.每页记录数,5.页码
        $page = new Page($list,$this->url,$total,$listRows,$data['p'],$param);

        $this->assign('seach',$seach_condition_val);
        $this->assign('list',$list);
        $this->assign('page',$page);
        return $this->fetch($this->url);
    }

    /**
     * 职业者账户审核详情
     * @param   int     $data['id]      用户账号ID
     * @return  array   $info           账号详情数据
     */
    public function workerAccountDetail(){
        $data = $this->param();
        
        $info = (new UserWorker())->getUserWorker(array('id'=>$data['id']));
        $this->assign('info',$info[0]);
        return $this->fetch($this->url);
    }

    /**
     * 职业者账号审核动作
     * @param   int         $data['id']     用户账号ID
     * @param   int         $data['status]  用户账号审核状态
     * @param   string      $data['reason]  用户账号审核原因
     * @return  array                       账号审核结果
     */
    public function workerAccount(){
        $data = $this->param();
        $UserWorker = new UserWorker();


        if($data['status']!=1 && empty($data['reason'])){
            return json(array('status'=>0,'Msg'=>'请务必填写未通过原因!!'));
        }

        //确保无重复审核
        $usw = $UserWorker->getUserWorker(array('id'=>$data['id'],'status'=>2),'id');
        if(empty($usw[0]['id'])){
            return json(array('status'=>0,'Msg'=>'该账户已审核请勿重复操作!!'));die;
        }
        
        $where = array('id'=>$data['id'],'status'=>$data['status'],'reason'=>!empty($data['reason'])?$data['reason']:'');
        if($data['status']!=1){
            $where['step'] = 1;
            $where['client_contract'] = '';
            $where['is_sign'] = '';
            $where['contract_code'] = '';
        };
        // 职业者账户审核
        $Nickname = session('Nickname');
        $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户审核企业账号【ID:{$data['id']}】");
        $result = $this->addUpdate($UserWorker,'addUserWorker', $logArtion ,$where,$type='审核');

        if($result['status']==1){
            if($data['status']==1){
                $notice['content'] = "您的账号审核结果为：<span style='color:green;'>审核通过</span>。";
            }else{
                $notice['content'] = "您的账号审核结果为：<span style='color:red;'>审核未通过</span>；可能原因：{$data['reason']} 可点击“账号设置”重新提交哦。";
            }
            // 发送消息至职业者账户通知结果
            $notice['u_id'] = $data['id'];
            $notice['type'] = '账号审核消息';
            (new NoticeWorker())->addNotice($notice);
        }
        if($this->isAjax()){
            
            return json($result);
        }else{
            $this->success($result['Msg'], '/audit/workerAccountList');
        }
    }

    /**
     * 职业者签约审核列表
     * @param   int     $data['p]   页码
     * @return  array   $list,$page 列表数据,翻页Html
     */
    public function workerContractReviewL(){
        $data = $this->param();

        if($this->isAjax()){

        }else{
            
            $where = '';
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
                            case "name":
                                // 企业单位
                                $where[] = array('b.title','like',"%{$val[1]}%");
                                break;
                            case "title":
                                $where[] = array('r.'.$val[0],'like',"%{$val[1]}%");
                                break;
                            case "contract_code":
                                $where[] = array('c.'.$val[0],'like',"%{$val[1]}%");
                                break;
                            case "nickname":
                                $where[] = array('u.'.$val[0],'like',"%{$val[1]}%");
                                break;
                            case "update_time":
                                $where[] = array('c.'.$val[0],'like',"%{$val[1]}%");
                                break;
                            case "industry":
                                $where[] = array('r.'.$val[0],'like',"%{$val[1]}%");
                                break;
                            case "sex":
                                $where[] = array('u.'.$val[0],'eq',$val[1]);
                                break;
                            default:
                                $where[] = array('r.'.$val[0],'eq',$val[1]);
                                break;
                        }
                        $seach_condition_val[$val[0]] = $val[1];
                    }
                }
            }
            
            $contractWorker = new contractWorker();
            $data['p'] = !empty($data['p'])? $data['p']:1;
            $listRows = 20;
            $field = 'c.*,b.title,u.nickname,r.industry,r.title as project_title,
            r.create_time as release_create_time,r.people_num,
            r.contract_boss_template_id';
            $join_1[0] = 'pgy_user_worker u';
            $join_1[1] = 'u.id = c.worker_uid';
            $join_2[0] = 'pgy_release_boss r';
            $join_2[1] = 'r.id = c.release_id';
            $join_3[0] = 'pgy_user_boss b';
            $join_3[1] = 'b.id = r.u_id';
            $where[] = array('c.status','neq',0);
            $order = 'c.create_time desc, c.id desc';
            
            $list = $contractWorker
                ->alias('c')
                ->field($field)
                ->join($join_1[0],$join_1[1])
                ->join($join_2[0],$join_2[1])
                ->join($join_3[0],$join_3[1])
                ->where($where)
                ->order($order)
                ->page($data['p'],$listRows)
                ->select()
                ->toArray();
            $total = $contractWorker->alias('c')->join($join_1[0],$join_1[1])->join($join_2[0],$join_2[1])->join($join_3[0],$join_3[1])->where($where)->count();
            // 1.当前页数据,2.路由,3.总记录数,4.每页记录数,5.页码
            $page = new Page($list,$this->url,$total,$listRows,$data['p'],$param);
            
            $this->assign('seach',$seach_condition_val);
            $this->assign('list',$list);
            $this->assign('page',$page);
            
            return $this->fetch($this->url);
        }
    }

    /**
     * 职业者签约审核详情
     * @param   int     $data['id]      签约合同数据ID
     * @return  array                   合同全部信息
     */
    public function workerContractInfo(){
        $data = $this->param();

        $ContractWorker = new ContractWorker();
        $field = 'c.*,b.title,u.nickname,r.industry,r.title as project_title,r.people_num';
        $map[] = array('c.status','neq',0);
        $map[] = array('c.id','=',$data['id']);
        $info = $ContractWorker
                ->alias('c')
                ->field($field)
                ->join('pgy_user_worker u','u.id = c.worker_uid')
                ->join('pgy_release_boss r','r.id = c.release_id')
                ->join('pgy_user_boss b','b.id = r.u_id')
                ->where($map)
                ->select()
                ->toArray();

        $this->assign('info',$info[0]);
        return $this->fetch($this->url);
    }

    /**
     * 职业者签约审核动作
     * @param   int     $data['id']     合同ID
     * @param   int     $data['status'] 审核状态
     * @param   int     $data['worker_uid']   职业者用户ID
     * @param   string  $data['title]   项目名称
     * @param   string  $data['reason'] 审核不通过是的原因
     * @return  array                   审核处理的结果
     */
    public function workerContractAction(){
        $data = $this->param();

        $ContractWorker = new ContractWorker();
        $result['status'] = 0;
        if(empty($data['id']) || empty($data['worker_uid']) || empty($data['status'])){
            $result['Msg'] = 'ID或状态丢失';
            return json($result);
        }
        if($data['status']!=1 && empty($data['reason'])){
            return json(array('status'=>0,'Msg'=>'请务必填写未通过原因!!'));
            
        }
        if(!getUserWorkerIsSign($data['id'],$data['worker_uid'])){
            $result['Msg'] = '职业者确认中,需自由职业者签约后才可审核';
            if($this->isAjax()){
                return json($result);
            }else{
                $this->error($result['Msg']);
            }
        }
        // die;
        
        if($data['status']==3){
            // 当审核未通过时需撤销已记录的合同并要求重新职业者签约
            $where = array(
                'id'=>              $data['id'],
                'status'=>          $data['status'],
                'is_sign'=>         0,
                'contract_id'=>     '',
                'contract_code'=>   '',
                'reason'=>          !empty($data['reason'])?$data['reason']:''
            );
        }else{
            $where = array('id'=>$data['id'],'status'=>$data['status'],'reason'=>!empty($data['reason'])?$data['reason']:'');
        }
        
        // 职业者业务审核
        $Nickname = session('Nickname');
        $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户审核职业者业务签约【ID:{$data['id']}】");
        $result = $this->addUpdate($ContractWorker,'addContractWorker', $logArtion ,$where,$type='业务签约审核');
        if($result['status']==1){
            
            if($data['status']==1){
                $notice['content'] = "您有一条业务签约【{$data['title']}】审核结果为：<span style='color:green;'>审核通过</span>。";
            }else{
                $notice['content'] = "您有一条业务签约【{$data['title']}】审核结果为：<span style='color:red;'>审核未通过</span>; 可能原因：{$data['reason']} 您可前往业务签约详情重新提交";
            }
            // 发送消息至职业者账户通知结果
            $notice['u_id'] = $data['worker_uid'];
            $notice['type'] = '业务签约消息';
            (new NoticeWorker())->addNotice($notice);
        }
        if($this->isAjax()){
            return json($result);
        }else{
            if($result['status']==1){
                $this->success($result['Msg'],'/audit/workerContractReviewL');
            }
            $this->error($result['Msg']);
        }
        
    }

    /**
     * 企业工作单位账户审核
     * @param   int     $p          页数
     * @return  array   $list,$page 列表数据,翻页Html
     */
    public function bossAccountList(){
        
        $data = $this->param();
        $UserBoss = new UserBoss();

        $where = '';
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
                        case "name":
                            $where[] = array($val[0],'like',"%{$val[1]}%");
                            break;
                        case "address":
                            $where[] = array($val[0],'like',"%{$val[1]}%");
                            break;
                        case "industry":
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
        $list = $UserBoss->getPage($where,true,'id desc',$data['p'],$listRows);
        $total = $UserBoss->where($where)->count();
        // 1.当前页数据,2.路由,3.总记录数,4.每页记录数,5.页码
        $page = new Page($list,$this->url,$total,$listRows,$data['p'],$param);
        
        $this->assign('seach',$seach_condition_val);
        $this->assign('list',$list);
        $this->assign('page',$page);
        return $this->fetch($this->url);
    }

    /**
     * 企业用工单位账户审核详情
     * @param   int     $data['id]      用户账号ID
     * @return  array   $info           账号详情数据
     */
    public function bossAccountDetail(){
        $data = $this->param();
        
        $info = (new UserBoss())->getUserBoss(array('id'=>$data['id']));
        $this->assign('info',$info[0]);
        return $this->fetch($this->url);

    }

    /**
     * 企业用工账号审核动作
     * @param   int         $data['id']     用户账号ID
     * @param   int         $data['status]  用户账号审核状态
     * @param   string      $data['reason]  用户账号审核原因
     * @return  array                       账号审核结果
     */
    public function bossAccount(){
        $data = $this->param();
        $UserBoss = new UserBoss();

        if($data['status']!=1 && empty($data['reason'])){
            return json(array('status'=>0,'Msg'=>'请务必填写未通过原因!!'));
        }

        //确保无重复审核
        $usb = $UserBoss->getUserBoss(array('id'=>$data['id'],'status'=>2),'id');
        if(empty($usb[0]['id'])){
            return json(array('status'=>0,'Msg'=>'该账户已审核请勿重复操作!!'));
        }
        
        //确认合同是都正确
        if(empty($data['sure_contract']) && $this->isAjax()){
            return json(array('status'=>0,'Msg'=>'请确认合同是否正确!!'));
        }

        if(!empty($data['sure_contract']) && $data['sure_contract']!=1){
            $where = array(
                'id'                =>$data['id'],
                'is_sign'           =>0,
                'client_contract'   =>0,
                'contract_code'     =>0,
                'status'            =>$data['status'],
                'reason'            =>!empty($data['reason'])?$data['reason']:''
            );
        }else{
            $where = array('id'=>$data['id'],'status'=>$data['status'],'reason'=>!empty($data['reason'])?$data['reason']:'');
        }
        // 企业账户审核
        $Nickname = session('Nickname');
        $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户审核企业账号【ID:{$data['id']}】");
        $result = $this->addUpdate($UserBoss,'addUserBoss', $logArtion ,$where,$type='审核');

        if($result['status']==1){
            
            if($data['status']==1){
                $notice['content'] = "您的账号审核结果为：<span style='color:green;'>审核通过</span>。注:若仍遇到系统提示账号审核中,可以尝试退出登录后再重新登录。";
            }else{
                $notice['content'] = "您的账号审核结果为：<span style='color:red;'>审核未通过</span>；可能原因：{$data['reason']} 可前往“<a href='/firm/appealAccount.html'>账号申诉</a>”中重新修改提交哦。注:若遇到系统提示阻挡,无法申诉时,可以尝试退出登录后再重新登录。";
            }
            // 发送消息至企业账户通知结果
            $notice['u_id'] = $data['id'];
            $notice['type'] = '账号审核消息';
            (new NoticeBoss())->addNotice($notice);
        }
        if($this->isAjax()){
            
            return json($result);
        }else{
            $this->success($result['Msg'], '/audit/bossAccountList');
        }
    }

    /**
     * 企业用工单位需求审核
     * @param   int     $data['p']      翻页
     * @return  array   $list,$page     列表数据,翻页页码
     */
    public function bossReleaseList(){

        $data = $this->param();
        $Release = new ReleaseBoss();

        $where = '';
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
                if($val[1]){
                    if(in_array($val[0],array('name'))){
                        $name = '1';
                    }
                }
            }
            $r = '';
            $u = '';
            if(!empty($name)){
                $r = 'r.';
                $u = 'u.';
            }
            foreach($seach_val as $k =>$val){
                if($val[1]){
                    switch($val[0]){
                        case "name":
                            // 企业单位
                            $where[] = array($u."title",'like',"%{$val[1]}%");
                            break;
                        case "title":
                            $where[] = array($r.$val[0],'like',"%{$val[1]}%");
                            break;
                        case "industry":
                            $where[] = array($r.$val[0],'like',"%{$val[1]}%");
                            break;
                        default:
                            $where[] = array($r.$val[0],'eq',$val[1]);
                            break;
                    }
                    $seach_condition_val[$val[0]] = $val[1];
                }
            }
        }
        
        $data['p'] = !empty($data['p'])? $data['p']:1;
        $listRows = 20;

       
        if(!empty($name)){
            $list = $Release->alias('r')
                ->field('r.*')
                ->join('pgy_user_boss u','r.u_id=u.id')
                ->where($where)
                ->order('r.id desc')
                ->select();
            $total = $Release->alias('r')->join('pgy_user_boss u','r.id=u.id')->where($where)->count();
        }else{
            $list = $Release->getPage($where,true,'id desc',$data['p'],$listRows);
            $total = $Release->where($where)->count();
        }
        // 1.当前页数据,2.路由,3.总记录数,4.每页记录数,5.页码
        $page = new Page($list,$this->url,$total,$listRows,$data['p'],$param);
        // var_dump('<pre>',$list);
        $this->assign('seach',$seach_condition_val);
        $this->assign('list',$list);
        $this->assign('page',$page);
        return $this->fetch($this->url);
    }

     /**
     * 企业用工单位需求详情
     * @param   int     $data['id]      需求ID
     * @return  array   $info           需求详情数据
     */
    public function bossReleaseDetail(){
        
        $data = $this->param();
        $ReleaseBoss = new ReleaseBoss();

        $info = $ReleaseBoss->getReleaseBoss(array('id'=>$data['id']));
            
        if(!empty($info[0]) && $info[0]['is_contract']==1){
            
            $where[] = array('industry','like','%'.$info[0]['industry'].'%');
            $user_worker = (new UserWorker())->getUserWorker($where,'id,nickname,phone');
            $contract_worker_where[] = array('release_id','=',$info[0]['id']);
            $contract_worker_where[] = array('added_status','=',1);
            $contract_worker_where[] = array('status','neq',0);
            $contract_worker = (new ContractWorker())->getContractWorker($contract_worker_where,'id,worker_uid');
            if(!empty($contract_worker[0])){
                foreach($contract_worker as $val){
                    $check_worker[] = $val['worker_uid'];
                }
            }
        }else{
            $user_worker = '';
            $check_worker = '';
        }
        
        $this->assign('userWorker',$user_worker);
        $this->assign('check_worker',$check_worker);
        $this->assign('info',$info[0]);
        return $this->fetch($this->url);   
    }

    /**
     * 企业需求删除
     * @param   int     $data['id']     需求ID
     * @return                          删除结果
     */
    public function bossReleaseDel(){
        $data = $this->param();
        $ReleaseBoss = new ReleaseBoss();
        
        $where = array('id'=>$data['id']);
        // 删除
        $Nickname = session('Nickname');
        $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户删除一个企业需求【ID:{$data['id']}】");
        $result = $this->addUpdate($ReleaseBoss,'deleteReleaseBoss', $logArtion ,$where,$type='删除');

        if($result['status']==1){
            $this->success($result['Msg'],'/audit/bossReleaseList');
        }else{
            $this->errror($result['Msg']);
        }
    }

    /**
     * 企业用工单位需求审核动作
     * @param   int     $data['id]      需求ID
     * @param   int     $data['status'] 审核状态
     * @param   string  $data['reason]  审核原因
     * @return  array                   审核结果
     */
    public function bossRelease(){
        $data = $this->param();
        $Release = new ReleaseBoss();
        $ContractBoss = new ContractBoss();

        if($data['status']!=1 && empty($data['reason'])){
            return json(array('status'=>0,'Msg'=>'请务必填写未通过原因!!'));
        }

        //确保无重复审核
        $rel = $Release->getReleaseBoss(array('id'=>$data['id'],'status'=>2),'id');
        if(empty($rel[0]['id'])){
            return json(array('status'=>0,'Msg'=>'该需求已审核请勿重复操作!!'));
        }

        if($data['status']==1){
            try{
                $boss_contract = C('WEB_CONTRACT_BOSS_TEMPLATE_ID');
                if(empty($boss_contract)){
                    $result['Msg'] = "请确认系统平台设置中服务合同的正确性!";
                    if($this->isAjax()){
                        return json($contract_ret);
                    }else{
                        $this->error($contract_ret['Msg'], '/audit/bossReleaseList');
                    }
                }
                $contract_boss['release_id'] = $data['id'];
                $contract_boss['boss_uid'] = $data['u_id'];
                // 新增所选职工的合同记录数据
                $contract_boss_id = $ContractBoss->addContractBoss($contract_boss);
                if(empty($contract_boss_id)){
                    $contract_ret['status'] = 0;
                    $contract_ret['Msg'] = "新建企业合同中失败!";
                    if($this->isAjax()){
                        return json($contract_ret);
                    }else{
                        $this->error($contract_ret['Msg'], '/audit/bossReleaseList');
                    }
                }
            }catch(\Exception $e){
                // 操作失败 记录LOG日志文件
                indexLogFile($e);
                $contract_ret['status'] = 0;
                $contract_ret['Msg'] = "失败原因可能:{$e->getMessage()}";
                if($this->isAjax()){
                    return json($contract_ret);
                }else{
                    $this->error($contract_ret['Msg'], '/audit/bossReleaseList');
                }
            }
        }

        $where = array(
            'id'=>$data['id'],
            'status'=>$data['status'],
            'reason'=>!empty($data['reason'])?$data['reason']:'',
            'contract_boss_template_id'=>$data['status']==1?$boss_contract:'',
        );

        // 企业用工需求审核
        $Nickname = session('Nickname');
        $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户审核企业需求【ID:{$data['id']}】");
        $result = $this->addUpdate($Release,'addReleaseBoss', $logArtion ,$where,$type='审核');

        if($result['status']==1){
            
            if($data['status']==1){
                $notice['content'] = "您的用工需求<a href='/boss/recordingDetail/id/{$data['id']}.html'>【点击这里跳转查看】</a>审核结果为：<span style='color:green;'>审核通过</span>。<a href='/boss/management.html'>【点击我】</a>去签约管理看看";
            }else{
                $notice['content'] = "您的用工需求<a href='/boss/recordingDetail/id/{$data['id']}.html'>【点击这里跳转查看】</a>审核结果为：<span style='color:red;'>审核未通过</span>；可能原因：{$data['reason']} 可前往“<a href='/boss/appealRelease/id/{$data['id']}.html'>需求申诉</a>”中重新修改提交哦。";
            }
            // 发送消息至企业账户通知结果
            $notice['u_id'] = $data['u_id'];
            $notice['type'] = '需求审核消息';
            (new NoticeBoss())->addNotice($notice);
        }else{
            $ContractBoss->deleteContractBoss(array('id'=>$contract_boss_id));
        }
        if($this->isAjax()){
            
            return json($result);
        }else{
            $this->success($result['Msg'], '/audit/bossReleaseList');
        }
    }

    /**
     * 企业需求所需人员分配
     * @param   array   $data   前台表单数据
     * @return  josn            数据提交处理后的状态  
     */
    public function bossDistribution(){

        $data = $this->param();
        $ContractWorker = new ContractWorker();
        $ContractBoss = new ContractBoss();
        $ReleaseBoss = new ReleaseBoss();
        $UserWorker = new UserWorker();

        if($this->isAjax()){
            $result['status'] = 0;
            if(empty($data['id']) || empty($data['boss_uid'])){
                $result['Msg'] = '数据ID丢失或企业用户ID丢失!';
                return json($result);
            }
            if(empty($data['worker_uid']) || count($data['worker_uid'])!=$data['people_num']){
                $result['Msg'] = "请正确选择{$data['people_num']}人";
                return json($result);
            }
            if(!getUserBossIsSign($data['id'],$data['boss_uid'])){
                $result['Msg'] = '企业未签约服务合同,暂不能分配';
                return json($result);
            }
            $data['worker_contract'] = C('WEB_CONTRACT_WORKER_TEMPLATE_ID');
            if(empty($data['worker_contract'])){
                $result['Msg'] = "请确认系统平台设置中承包合同的正确性!";
                return json($result);
            }
            
            // if(empty($data['worker_contract']) || empty($data['boss_contract'])){
            //     $result['Msg'] = "请确认所有合同是否已正常上传!";
            //     return json($result);
            // }

            // try{
            //     $contract_boss['release_id'] = $data['id'];
            //     $contract_boss['boss_uid'] = $data['boss_uid'];
            //     // 新增所选职工的合同记录数据
            //     $contract_boss_id = $ContractBoss->addContractBoss($contract_boss);
            //     if(empty($contract_boss_id)){
            //         $result['Msg'] = "新建企业合同中失败!";
            //         return json($result);
            //     }
            // }catch(\Exception $e){
            //     // 操作失败 记录LOG日志文件
            //     indexLogFile($e);
            //     $result['Msg'] = "失败原因可能:{$e->getMessage()}";
            //     return json($result);
            // }

            try{
                foreach($data['worker_uid'] as $key =>$val){
                    $contract_worker[$key]['release_id'] = $data['id'];
                    $contract_worker[$key]['worker_uid'] = $val;
                    $contract_worker[$key]['boss_uid'] = $data['boss_uid'];

                    // 职工用户的消息通知
                    $worker_notice[$key]['u_id'] = $val;
                    $worker_notice[$key]['type'] = '签约提醒消息';
                    $worker_notice[$key]['content'] = "您有一份合同需签约,请前往业务签约进行签约";
                }
                // 新增所选的职工进行记录生成每人一份的独立的合同数据
                $contract_worker_id = $ContractWorker->allAddContractWorker($contract_worker);
                if(empty($contract_worker_id[0]['id'])){
                    // 新增失败
                    // 删除刚刚新增成功的
                    $ContractWorker->deleteContractWorker(array('added_status'=>0));
                    // $ContractBoss->deleteContractBoss(array('id'=>$contract_boss_id));
                    $result['Msg'] = "新建某职工合同中失败!";
                    return json($result);die;
                }else{
                    for($i=0; $i<count($contract_worker_id); $i++){
                        $worker_id[$i]['id'] = $contract_worker_id[$i]['id'];
                        $worker_id[$i]['added_status'] = 1;

                        $worker_del[] = $contract_worker_id[$i]['id'];

                    }
                }
                // 更新各职工的合同新增状态(added_status==1)
                $r = $ContractWorker->allAddContractWorker($worker_id);
                if(empty($r[0]['id'])){
                    $ContractWorker->deleteContractWorker(array('id'=>$worker_del));
                    // $ContractBoss->deleteContractBoss(array('id'=>$contract_boss_id));
                    $result['Msg'] = "合同状态更新失败!";
                    return json($result);die;
                }else{
                    // 发送消息提醒签约(企业账号|各职工账号)
                    $boss_notice['u_id'] = $data['boss_uid'];
                    $boss_notice['type'] = '签约提醒消息';
                    $boss_notice['content'] = "您有一份合同需签约,请前往签约管理进行签约";
                    (new NoticeBoss())->addNotice($boss_notice);
                    (new NoticeWorker())->allAddNotice($worker_notice);

                    $Nickname = session('Nickname');
                    $where['id'] = $data['id'];
                    $where['is_contract'] = 1;
                    $where['contract_worker_template_id'] = $data['worker_contract'];
                    // $where['contract_boss_template_id'] = $data['boss_contract'];
                    $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户分配企业需求【ID:{$data['id']}】职工人员{$data['people_num']}人");
                    $ret = $this->addUpdate($ReleaseBoss,'addReleaseBoss', $logArtion ,$where,$type='分配');
                    if($ret['status']==1){
                        $result['status'] = 1;
                        $result['Msg'] = "分配成功,已通知企业及各职业者人员进行签约!";
                        return json($result);
                    }else{
                        $ContractWorker->deleteContractWorker(array('id'=>$worker_del));
                        // $ContractBoss->deleteContractBoss(array('id'=>$contract_boss_id));
                    }
                }
               
            }catch(\Exception $e){
                // 新增失败
                // 删除全部新增状态(added_status==0)的职工合同并删除企业合同
                $ContractWorker->deleteContractWorker(array('added_status'=>0));
                // $ContractBoss->deleteContractBoss(array('id'=>$contract_boss_id));
                if(!empty($worker_del)){
                    $ContractWorker->deleteContractWorker(array('id'=>$worker_del));
                }
                // 操作失败 记录LOG日志文件
                indexLogFile($e);
                $result['Msg'] = "失败原因可能:{$e->getMessage()}";
                return json($result);
            }

        }else{
            $rel = $ReleaseBoss->getReleaseBoss(array('id'=>$data['id'],'status'=>1),'id,u_id,industry,people_num,is_contract');
            
            if(!empty($rel[0])){
                if($rel[0]['is_contract']==1){
                    $this->error('该条数据管理员已分配');
                }
                $user_worker = '';
                $check_worker = array();
                $where[] = array('industry','like','%'.$rel[0]['industry'].'%');
                $where[] = array('status','eq',1);
                $user_worker = $UserWorker->getUserWorker($where,'id,nickname,phone');
                $contract_worker = $ContractWorker->getContractWorker(array('release_id'=>$rel[0]['id'],'status'=>array(1,2),'added_status'=>1),'id,worker_uid');
                if(!empty($contract_worker[0])){
                    foreach($contract_worker as $val){
                        $check_worker[] = $val['worker_uid'];
                    }
                }
            }else{
                $user_worker = '';
                $check_worker = array();
            }
           
            $this->assign('release',$rel[0]);
            $this->assign('userWorker',$user_worker);
            $this->assign('check_worker',$check_worker);
            return $this->fetch($this->url);
        }
    }

    /**
     * 职业者个人签约变动 (由于工作变动造成的用工人员的变动,需为职业者提供特殊通道签约)
     * 
     */
    public function workerIndividual(){

        $data = $this->param();
        $ContractWorker = new ContractWorker();
        $ReleaseBoss = new ReleaseBoss();
        $UserWorker = new UserWorker();
        $result['status'] = 0;

      
        $rel = $ReleaseBoss->getReleaseBoss(array('id'=>$data['id'],'status'=>1),'id,u_id,industry,people_num,is_contract');
        if(!empty($rel[0])){
            if($rel[0]['is_contract']==0){
                if($this->isAjax()){
                    $result['Msg'] = '该条数据管理员尚未分配,不可变更';
                    return json($result);
                }else{
                   $this->error('该条数据管理员尚未分配');  
                }
            }
            $where[] = array('industry','like','%'.$rel[0]['industry'].'%');
            $where[] = array('status','=',1);
            $user_worker = $UserWorker->getUserWorker($where,'id,nickname,phone');
            $contract_worker = $ContractWorker->getContractWorker(array('release_id'=>$rel[0]['id'],'status'=>array(1,2),'added_status'=>1),'id,worker_uid');
            if(!empty($contract_worker[0])){
                foreach($contract_worker as $val){
                    $check_worker[] = $val['worker_uid'];
                }
            }else{
                $check_worker = array();
            }
        }else{
            if($this->isAjax()){
                $result['Msg'] = '此数据不存在';
                return json($result);
            }else{
                 $this->error('数据不存在');
            }
        }

        if($this->isAjax()){
            
            if(empty($data['id']) || empty($data['boss_uid'])){
                $result['Msg'] = '数据ID丢失或企业用户ID丢失!';
                return json($result);
            }
            if(empty($data['worker_uid']) || count($data['worker_uid'])!=$data['people_num']){
                $result['Msg'] = "请正确选择{$data['people_num']}人";
                return json($result);
            }

            // 对比提交人数与已记录的人数差异(1.相比本次取消多少人;2.相比本次增加多少人)
            $new_worker = '';
            $clear_worker = '';
            foreach($data['worker_uid'] as $val){
                if(!in_array($val,$check_worker)){
                    $new_worker[] = $val; // 新增的
                }
            }
            foreach($check_worker as $key => $value){
                if(!in_array($value,$data['worker_uid'])){
                    // 取消的
                    $clear_worker[] = $ContractWorker
                        ->field('id,worker_uid,release_id,status')
                        ->where('status','in','1,2')
                        ->where(array('worker_uid'=>$value,'release_id'=>$data['id'],'added_status'=>1))
                        ->select()
                        ->toArray()[0]; 
                    
                }
            }
            
            if(!empty($new_worker)){
                
                // // 测试改变被取消的职工合同
                // foreach($clear_worker as $key =>$val){
                //     $clear_worker[$key]['status'] = 0;
                // }
                // $clear_w =  $ContractWorker->allAddContractWorker($clear_worker);
                
                // var_dump($clear_worker);
                // die;
                // //// 结束线 /////

                try{
                    // 1.将新增的通知签约
                    foreach($new_worker as $key => $value){
                        // $contract_worker_add[$key]['contract_template_id'] = $contract_worker[0]['contract_template_id'];
                        $contract_worker_add[$key]['release_id'] = $data['id'];
                        $contract_worker_add[$key]['worker_uid'] = $value;
                        $contract_worker_add[$key]['boss_uid'] = $data['boss_uid'];

                        // 职工用户的消息通知
                        $worker_notice[$key]['u_id'] = $value;
                        $worker_notice[$key]['type'] = '签约提醒消息';
                        $worker_notice[$key]['content'] = "您有一份合同需签约,请前往业务签约进行签约";
                    }
                    $c = $ContractWorker->allAddContractWorker($contract_worker_add);
                    if(empty($c[0]['id'])){
                        // 新增失败
                        // 删除刚刚新增成功的
                        $ContractWorker->deleteContractWorker(array('added_status'=>0));
                        $result['Msg'] = "新建某职工合同中失败!";
                        return json($result);die;
                    }else{
                        for($i=0; $i<count($c); $i++){
                            $worker_id[$i]['id'] = $c[$i]['id'];
                            $worker_id[$i]['added_status'] = 1;

                            $worker_del[] = $c[$i]['id'];
                        }
                    }
                    // 2.将取消的合同状态取消(status==0)
                    foreach($clear_worker as $key =>$val){
                        $clear_worker_0[$key] = $val;
                        $clear_worker_1[$key] = $val;
                        $clear_worker_0[$key]['status'] = 0;
                        $clear_worker_1[$key]['status'] = 1;
                    }
                    $clear_w = $ContractWorker->allAddContractWorker($clear_worker_0);
                    if(empty($clear_w[0]['id'])){
                        $ContractWorker->deleteContractWorker(array('id'=>$worker_del));
                        $result['Msg'] = "合同状态更新失败!";
                        return json($result);die;
                    }
                    // 更新各职工的合同新增状态(added_status==1)
                    $r = $ContractWorker->allAddContractWorker($worker_id);
                    if(empty($r[0]['id'])){
                        $ContractWorker->allAddContractWorker($clear_worker_1);
                        $ContractWorker->deleteContractWorker(array('id'=>$worker_del));
                        $result['Msg'] = "合同状态更新失败!";
                        return json($result);die;
                    }else{
                        // 发送消息提醒签约(各职工账号)
                        (new NoticeWorker())->allAddNotice($worker_notice);

                        $Nickname = session('Nickname');
                        $where = array('id'=>$data['id'],'is_contract'=>1);
                        $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户变更签约分配企业需求【ID:{$data['id']}】变更职工人员".count($new_worker)."人");
                        $ret = $this->addUpdate($ReleaseBoss,'addReleaseBoss', $logArtion ,$where,$type='变更签约');
                        if($ret['status']==1){
                            $result['status'] = 1;
                            $result['Msg'] = "变更成功,已通知各职业者人员进行签约!";
                            return json($result);
                        }else{
                            $ContractWorker->allAddContractWorker($clear_worker_1);
                            $ContractWorker->deleteContractWorker(array('id'=>$worker_del));
                        }
                    }
                }catch(\Exception $e){
                    // 新增失败
                    // 删除全部新增状态(added_status==0)的职工合同并删除企业合同
                    $ContractWorker->deleteContractWorker(array('added_status'=>0));
                    if(!empty($worker_del)){
                        $ContractWorker->deleteContractWorker(array('id'=>$worker_del));
                    }
                    if(!empty($clear_worker_1)){
                        $ContractWorker->allAddContractWorker($clear_worker_1);
                    }
                    // 操作失败 记录LOG日志文件
                    indexLogFile($e);
                    $result['Msg'] = "失败原因可能:{$e->getMessage()}";
                    return json($result);
                }
            }else{
                $result['Msg'] = "检测到没有任何人员变动";
                return json($result);
            }
            
        }else{

            $this->assign('release',$rel[0]);
            $this->assign('userWorker',$user_worker);
            $this->assign('check_worker',$check_worker);
            return $this->fetch($this->url);
        }
    }

    /**
     * 企业签约审核列表
     * @param   int     $data['p']      页码
     * @return  array   $list,$page     列表数据,翻页Html
     */
    public function bossContractReviewL(){

        $data = $this->param();

        if($this->isAjax()){

        }else{

            $where = '';
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
                            case "name":
                                // 企业单位
                                $where[] = array('u.title','like',"%{$val[1]}%");
                                break;
                            case "title":
                                $where[] = array('r.'.$val[0],'like',"%{$val[1]}%");
                                break;
                            case "contract_code":
                                $where[] = array('c.'.$val[0],'like',"%{$val[1]}%");
                                break;
                            case "nickname":
                                $where[] = array('u.'.$val[0],'like',"%{$val[1]}%");
                                break;
                            case "update_time":
                                $where[] = array('c.'.$val[0],'like',"%{$val[1]}%");
                                break;
                            case "industry":
                                $where[] = array('r.'.$val[0],'like',"%{$val[1]}%");
                                break;
                            default:
                                $where[] = array('r.'.$val[0],'eq',$val[1]);
                                break;
                        }
                        $seach_condition_val[$val[0]] = $val[1];
                    }
                }
            }

            $contractBoss = new contractBoss();
            $data['p'] = !empty($data['p'])? $data['p']:1;
            $listRows = 20;
            $field = 'c.*,u.title,r.industry,r.create_time as release_time,r.people_num,r.contract_boss_template_id,r.title as project_title';
            $join_1[0] = 'pgy_user_boss u';
            $join_1[1] = 'u.id = c.boss_uid';
            $join_2[0] = 'pgy_release_boss r';
            $join_2[1] = 'r.id = c.release_id';
            $order = 'c.id desc';
            
            $list = $contractBoss
                ->alias('c')
                ->field($field)
                ->join($join_1[0],$join_1[1])
                ->join($join_2[0],$join_2[1])
                ->where($where)
                ->order($order)
                ->page($data['p'],$listRows)
                ->select()
                ->toArray();
            $total = $contractBoss->alias('c')->join($join_1[0],$join_1[1])->join($join_2[0],$join_2[1])->where($where)->count();
            // 1.当前页数据,2.路由,3.总记录数,4.每页记录数,5.页码
            $page = new Page($list,$this->url,$total,$listRows,$data['p'],$param);
            
            $this->assign('seach',$seach_condition_val);
            $this->assign('list',$list);
            $this->assign('page',$page);
            
            return $this->fetch($this->url);
        }
    }

    /**
     * 企业签约审核详情
     * @param   int     $data['id']     业务签约ID
     */
    public function bossContractReviewInfo(){
        $data = $this->param();

        $ContractBoss = new ContractBoss();
        $where[] = array('c.id','=',$data['id']);
        $field = 'c.*,r.title,r.contract_boss_template_id';
        $info = $ContractBoss->alias('c')
                ->field($field)
                ->where($where)
                ->join('pgy_release_boss r','r.id=c.release_id')
                ->select()
                ->toArray();

        $this->assign('info',$info[0]);
        return $this->fetch($this->url);
    }

    /**
     * 企业业务签约审核动作
     * @param   int     $data['id']     企业业务签约ID
     * @param   int     $data['u_id']   企业用户ID
     * @param   int     $data['status'] 审核状态
     * @param   string  $data['reason'] 审核不通过原因,通过则忽略
     * @return  array                   审核处理结果
     */
    public function bossContractAction(){
        $data =  $this->param();
        $ContractBoss = new ContractBoss();
        $result['status'] = 0;

        if(empty($data['id']) || empty($data['status'])){
            $result['Msg'] = '业务ID或状态丢失';
            return json($result);die;
        }
        if($data['status']!=1 && empty($data['reason'])){
            $result['Msg'] = '请务必填写未通过原因';
            return json($result);die;
        }

        $Nickname = session('Nickname');
        if($data['status']==3){
            // 当审核未通过时需撤销已记录的合同并要求重新职业者签约
            $where = array(
                'id'            => $data['id'],
                'status'        => $data['status'],
                'is_sign'       => 0,
                'contract_id'   => '',
                'contract_code' => '',
                'reason'        => !empty($data['reason'])?$data['reason']:''
            );
        }else{
            $where = array('id'=>$data['id'],'status'=>$data['status'],'reason'=>!empty($data['reason'])?$data['reason']:'');
        }
        
        $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}审核企业业务签约【ID:{$data['id']}】");
        $result = $this->addUpdate($ContractBoss,'addContractBoss', $logArtion ,$where,$type='企业业务签约审核');
        if($result['status']==1){
            if($data['status']==1){
                $notice['content'] = "您的业务签约编号<a href='/boss/managementInfo/id/{$data['id']}.html'>【{$data['id']}】</a>审核结果为：<span style='color:green;'>审核通过</span>。";
            }else{
                $notice['content'] = "您的业务签约编号<a href='/boss/managementInfo/id/{$data['id']}.html'>【{$data['id']}】</a>审核结果为：<span style='color:red;'>审核未通过</span>；可能原因：{$data['reason']} 可前往“<a href='/boss/managementInfo/id/{$data['id']}.html'>业务详情</a>”中重新修改提交哦。";
            }
            // 发送消息至企业账户通知结果
            $notice['u_id'] = $data['u_id'];
            $notice['type'] = '业务签约消息';
            (new NoticeBoss())->addNotice($notice);
        }
        return json($result);
        
    }

    /**
     * 获取企业用工详情
     * @param   int     $data['boss_uid']   企业用户Id
     * @return  array                       企业发布的所有需求
     */
    public function getBossEmployment(){
        $data = $this->param();

        $result['status'] = 0;
        $UserBoss = new UserBoss();
        $where[] = array('b.id','eq',$data['boss_uid']);
        $field = 'b.title,b.industry,r.id,r.title as project_title,r.people_num,r.total_cost,r.status,r.create_time';
        $boss = $UserBoss->alias('b')
                ->field($field)
                ->join('pgy_release_boss r','r.u_id=b.id')
                ->where($where)
                ->order('r.create_time desc')
                ->select()
                ->toArray();
        if(!empty($boss)){
            $result['status'] = 1;
            $result['Msg'] = $boss;
        }else{
            $result['Msg'] = '暂无数据';
        }
        return json($result);
    }

    /**
     * 获取企业用工人员结算情况
     * @param   int     $data['release_id']   需求Id
     * @return  array                         需求中签约的所有人结算
     */
    public function getEmploymentPeople(){
        $data = $this->param();

        $ReleaseBoss = new ReleaseBoss();
        $MoneyWorker = new MoneyWorker();
        $field = 'r.title,r.industry,w.nickname,w.sex,c.worker_uid,c.settlement,c.contract_code,c.create_time';
        $where[] = array('r.id','eq',$data['release_id']);
        $where[] = array('c.status','neq',0);
        $where[] = array('c.added_status','neq',0);
        $user_list = $ReleaseBoss->alias('r')
                ->field($field)
                ->join('pgy_contract_worker c','c.release_id=r.id')
                ->join('pgy_user_worker w','w.id=c.worker_uid')
                ->where($where)
                ->order('c.create_time desc')
                ->select()
                ->toArray();

        if(!empty($user_list)){
            $id='';
            for($i=0; $i<count($user_list); $i++){
                $user_list[$i]['money'] = array();
                $id .= $user_list[$i]['worker_uid'].',';
            }
            if($id){
                $money_where[] = array('release_id','eq',$data['release_id']);
                $money_where[] = array('worker_uid','in',substr($id,0,-1));
                $money_where[] = array('status','neq',0);
                $field = 'worker_uid,amdin_id,actually_paid,vat_rate,personal_tax,handle';
                $user_worker_money = $MoneyWorker->getMoneyWorker($money_where,$field);
                if(!empty($user_worker_money)){
                    for($j=0; $j<count($user_list); $j++){
                        if($user_list[$j]['settlement']==1){
                            // 加入结算数据
                            foreach($user_worker_money as $key =>$v){
                                if($user_list[$j]['worker_uid']==$v['worker_uid']){
                                    $user_list[$j]['money'] = $v;
                                }
                            }
                        }
                    }
                }
            }
            $result['status'] = 1;
            $result['Msg'] = $user_list;
           
        }else{
            $result['Msg'] = '暂无数据';
        }
        return $result;
    } 

    /**
     * 获取职业者做工详情
     * @param   int     $data['worker_uid']     职业者用户ID
     * @return  array                           职业者做的所有工
     */
    public function getWorkerEmployment(){
        $data = $this->param();

        $result['status'] = 0;
        $ReleaseBoss = new ReleaseBoss();
        $where[] = array('c.worker_uid','eq',$data['worker_uid']);
        $where[] = array('c.status','neq',0);
        $where[] = array('c.added_status','neq',0);
        $field = 'b.title,r.industry,r.id,r.title as project_title,r.people_num,r.total_cost,c.id as contract_id,c.contract_code,c.status,c.create_time,c.worker_uid';
        $worker = $ReleaseBoss->alias('r')
                ->field($field)
                ->join('pgy_contract_worker c','c.release_id=r.id')
                ->join('pgy_user_boss b','b.id=r.u_id')
                ->where($where)
                ->order('c.create_time desc')
                ->select()
                ->toArray();
        
        if(!empty($worker)){
            $result['status'] = 1;
            $result['Msg'] = $worker;
        }else{
            $result['Msg'] = '暂无数据';
        }
       
        return json($result);
    }

    /**
     * 获取职业做工结算情况
     * @param   int     $data['contract_id']    职业者业务ID
     * @param   int     $data['worker_uid]      职业者ID
     * @return  array                           职业者在本次业务中的结算情况
     */
    public function getEmploymentMoney(){
        $data = $this->param();

        $MoneyWorker = new MoneyWorker();
        $where[] = array('c.worker_uid','eq',$data['worker_uid']);
        $where[] = array('c.id','eq',$data['contract_id']);
        $where[] = array('m.status','neq',0);
        $field = 'c.id,c.settlement,m.worker_uid,m.amdin_id,m.actually_paid,m.vat_rate,m.personal_tax,m.handle';
        $workre_money = $MoneyWorker->alias('m')
                ->field($field)
                ->join('pgy_contract_worker c','c.id=m.contract_id')
                ->where($where)
                ->select()
                ->toArray();
        if(!empty($workre_money)){
            $result['status'] = 1;
            $result['Msg'] = $workre_money;
        }else{
            $result['Msg'] = '暂无数据';
        }
        return json($result);
    }
}
