<?php

namespace App\Admin\Controllers;

use App\Models\Video;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
// use Encore\Admin\Controllers\ModelForm;
use App\Admin\Controllers\ModelForm;

class VideoController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->edirForm()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->createForm());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Video::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function editForm()
    {
        return Admin::form(Video::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function createForm()
    {
        return Admin::form(Video::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('title', '标题');
            $form->text('subtitle', '简介');
            $form->file('uri', '视频')
            // ->rules('mimes:mp4,flv,rmvb')
            ->uniqueName();

            $form->hidden('extension');
            $form->hidden('size');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');

            $form->saving(function (Form $form) {

                $form->extension = $form->uri->guessExtension();
                $form->size = $form->uri->getClientSize();
                if(empty($form->subtitle)) {
                    $form->subtitle = $form->uri->getClientOriginalName();
                }

            });
        });
    }
}
