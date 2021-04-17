<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Bill;
use App\Models\BillType;
use App\Models\Tag;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class BillController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Bill(), function (Grid $grid) {
            $grid->column('id')->sortable();
//            $grid->column('user_id');
            $grid->column('tag_id')->display(function () {
                return $this->tags->tag;
            })->label('info');
            $grid->column('type')->using([1 => '支出', 2 => '收入'])->label([
                1 => 'default',
                2 => 'danger',
            ]);

            $grid->column('money')->display(function ($val) {
                return '￥' . $val;
            });
            $grid->column('remarks');
            $grid->column('created_at', '创建/更新')->display(function () {
                return <<<HTML
            <span>{$this->created_at}</span>
            <br>
            <br>
            <span>{$this->updated_at}</span>
HTML;
            });
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Bill(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('tag_id');
            $show->field('type');
            $show->field('money');
            $show->field('remarks');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Bill(), function (Form $form) {
            $form->display('id');
//            $form->text('user_id');
            $form->select('tag_id')
                ->options(BillType::all()->pluck('tag', 'id'))->required();
            $form->radio('type')->options(['1' => '支出', '2' => '收入'])->default('1');
            $form->currency('money')->symbol('￥');
            $form->textarea('remarks');

            $form->date('created_at')->required();
            $form->display('updated_at');
        });
    }
}