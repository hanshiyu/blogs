<?php

namespace App\Admin\Controllers;

use App\Deposit;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;
use Encore\Admin\Layout\Content;
class DepositController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Deposit';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Deposit());
        $grid->disableActions();
        $grid->disableExport();
        $grid->disableFilter();
        $grid->column('id','编号');
        $grid->column('account','入账账户');
        $grid->column('amount','入账金额');
        $grid->column('company_logo','公司logo')->image('/uploads',50, 50);

        $grid->created_at('入账时间');


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Deposit::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Deposit());
        $form->text('account', '入账账户')->required();
        $form->text('amount', '入账金额')->required();
        $form->text('company_name', '公司名称')->required();
        $form->image('company_logo','公司logo')->uniqueName()->required();
        $form->saving(function (Form $form) {
            if(!is_null($form->account) && !is_null($form->amount) ){

            }else{
                    return back();
                }

        });
        return $form;
    }
}
