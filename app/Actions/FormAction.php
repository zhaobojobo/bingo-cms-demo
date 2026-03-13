<?php


namespace Site\Actions;


use Exception;
use Site\Action;
use Site\Helper;
use Site\Models\Form;

class FormAction extends Action
{
    public function __invoke($id)
    {
        try {
            $model = new Form();
            $form  = $model->find($id);
            $model->submit($form);
            return $this->success([], $form['ok_message'] ?: Helper::_('Message has been delivered'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
