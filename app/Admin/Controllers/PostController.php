<?php

namespace App\Admin\Controllers;

use App\Models\Post;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
// use Encore\Admin\Controllers\ModelForm;
use App\Admin\Controllers\ModelForm;

class PostController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('文章列表');
            $content->description('');

            $content->body($this->grid());
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑文章');
            $content->description('');

            $content->body($this->editForm()->edit($id));
        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('创建文章');
            $content->description('');

            $content->body($this->createForm());
        });
    }

    protected function grid()
    {
        return Admin::grid(Post::class, function (Grid $grid) {
            $grid->id('序号')->sortable();

            $grid->column('poster.name', '发布者');
            $grid->column('title', '标题');
            $grid->column('published', '用户可见')->display(function($published) {
                return $published ? '显示' : '隐藏';
            });

            $grid->updated_at('更新时间');
            $grid->created_at('创建时间');
        });
    }

    protected function editForm()
    {
        return Admin::form(Post::class, function (Form $form) {

            $form->display('id', '序号');

            $form->display('poster.name', '发布者');
            $form->text('title', '标题');
            $form->textarea('body', '内容');
            $form->switch('published', '用户可见');

            $form->display('updated_at', '更新时间');
            $form->display('created_at', '创建时间');
        });
    }

    protected function createForm()
    {
        return Admin::form(Post::class, function (Form $form) {
            $form->hidden('poster_id')->value(Auth('admin')->user()->id);
            $form->display('poster_name', '发布者')->value(Auth('admin')->user()->name);

            $form->text('title', '标题');
            $form->textarea('body', '内容');
            $form->switch('published', '用户可见');

            $form->ignore(['poster_name']);
        });
    }
}
