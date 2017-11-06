<?php

namespace App\Admin\Controllers;

use App\Models\Category;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Row;    
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
// use Encore\Admin\Controllers\ModelForm;
use App\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;

class CategoriesController extends Controller
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

            $content->header('分类');
            $content->description('');


            $content->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_base_path('categories'));

                    $form->select('parent_id', trans('admin.parent_id'))->options(Category::selectOptions());
                    $form->text('title', trans('admin.title'))->rules('required');
                    $form->text('uri', trans('admin.uri'));

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });
        });
    }

    /**
     * @return \Encore\Admin\Tree
     */
    protected function treeView()
    {
        return Category::tree(function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                $payload = "<strong>{$branch['title']}</strong>";

                // if (!isset($branch['children'])) {
                if (strlen($branch['uri']) > 0) {
                    if (url()->isValidUrl($branch['uri'])) {
                        $uri = $branch['uri'];
                    } else {
                        $uri = admin_base_path($branch['uri']);
                    }

                    $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag\">$uri</a>";
                }

                return $payload;
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function createForm()
    {
        return Category::form(function (Form $form) {
            $form->display('id', 'ID');

            $form->select('parent_id', trans('admin.parent_id'))->options(Category::selectOptions());
            $form->text('title', trans('admin.title'))->rules('required');
            $form->text('uri', trans('admin.uri'));

            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));
        });
    }

    /**
     * Edit interface.
     *
     * @param string $id
     *
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header(trans('admin.menu'));
            $content->description(trans('admin.edit'));

            $content->row($this->editForm()->edit($id));
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function editForm()
    {
        return Admin::form(Category::class, function (Form $form) {
            $form->display('id', '序号');

            $form->select('parent_id', '父级分类')
            ->options(Category::selectOptions())
            ->rules('required');

            $form->text('title', '分类名称')
            ->rules('required|string');

            $form->text('uri', '路径');

            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));
        });
    }
}
