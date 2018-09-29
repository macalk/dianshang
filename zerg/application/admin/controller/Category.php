<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\validate\Category as categoryV;

class Category extends Controller
{
    private $obj;
    function __construct(){
        $this->obj = model('Category');
    }

    public function index()
    {
        $parentID = input('parent_id',0,'intval');
        $categorys = $this->obj->getFirstCategory($parentID);
        return view('',['categorys'=>$categorys]);
    }
    public function add(){
        $categorys = $this->obj->getNormalFirstCategory();
        return view('',['categorys'=>$categorys]);
    }
    public function save(){
        // print_r($_POST);
        // print_r(input('post.'));
        // print_r(request()->prama);

        if(!request()->isPost()) {
            $this->error('请求失败');
        }
        $data = input('post.');
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)) {
            return $this->error($validate->getError());
        }
        if(!empty($data['id'])) {
            return $this->update($data);
        }
        //吧$data数据提交给model层
        $res = $this->obj->add($data);
        if($res) {
            return('新增成功');
        }else{
            return('新增失败');
        }
    }

    public function update($data) {
        $res = $this->obj->save($data,['id'=>intval($data['id'])]);
        if($res) {
            $this->success('更新成功');
        }else {
            $this->error('更新失败');
        }
    }

    //编辑页面
    public function edit($id){
        // var_dump(input('id'));
        if(intval($id)<1) {
            $this->error('参数不合法');
        }
        $category = $this->obj->get($id);
        $categorys = $this->obj->getNormalFirstCategory();
        return view('',[
            'categorys'=>$categorys,
            'category' =>$category
            ]);
    }
}
