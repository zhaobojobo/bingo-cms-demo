<?php


namespace Site\Actions;

use Site\Action;
use Site\Helper;
use Site\Models\Page;

class PageAction extends Action
{
    public function __invoke($id): string
    {
        $model = new Page();
        if (is_numeric($id)) {
            $page = $model->find($id);
        } else {
            $page = $model->findSlug($id);
        }

        if ($page->redirect) {
            $this->redirect(Helper::getUrl($page->redirect));
        }

        if (!$page || $page['hidden']) {
            return $this->err404();
        }
        if (!$page['review']) {
            if ($cache = $model->getCache($page['id'])) {
                $page = $cache;
            }
        }

        $this->view->addData(['page' => $page]);

        return $this->render([
            'page-' . $page->slug,
            'page-' . $page->id,
            'page'
        ]);
    }
}
