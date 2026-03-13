<?php


namespace Site\Actions;

use Site\Action;
use Site\Models\Page;

class HomeAction extends Action
{
    public function __invoke(): string
    {
        $model = new Page();
        $page = $model->find(1);
        if (!$page['review']) {
            if ($cache = $model->getCache($page['id'])) {
                $page = $cache;
            }
        }
        $this->view->addData(['page' => $page]);

        return $this->render(['index']);
    }
}
