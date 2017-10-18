<?php

namespace App\Admin\Controllers;

use App\Models\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
// use Encore\Admin\Controllers\ModelForm;
use App\Admin\Controllers\ModelForm;

class UserController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('用户列表');
            $content->description('');

            $content->body($this->grid());
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑用户');
            $content->description('');

            $content->body($this->editForm()->edit($id));
        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('创建用户');
            $content->description('');

            $content->body($this->createForm());
        });
    }

    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {
            $grid->id('序号')->sortable();

            $grid->name('用户名称');
            $grid->email('电子邮箱');

            $grid->updated_at('更新时间');
            $grid->created_at('创建时间');
        });
    }

    protected function createForm()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->text('name', '用户名称')
            ->rules('required|string|max:255');

            $form->email('email', '电子邮箱')
            ->rules('email');

            $form->password('password', '用户密码')
            ->rules('required|min:6');
            
            $form->password('password_confirm', '确认密码')
            ->rules('required|same:password|min:6');

            $form->ignore(['password_confirm']);
        });
    }

    protected function editForm($email = null)
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', '序号');
            $form->text('name', '用户名称');
            $form->display('email', '电子邮箱');

            $form->display('updated_at', '更新时间');
            $form->display('created_at', '创建时间');
        });
    }
}
