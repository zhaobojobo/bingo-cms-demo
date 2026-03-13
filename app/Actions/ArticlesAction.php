<?php


namespace Site\Actions;


use Site\Action;
use Site\Helper;
use Site\Models\Category;

class ArticlesAction extends Action
{
    public function __invoke($cat, $next = false): string
    {
        $model = new Category();
        if (is_numeric($cat)) {
            $cat = $model->find($cat);
        } else {
            $cat = $model->findSlug($cat);
        }

        if ($cat->redirect) {
            $this->redirect(Helper::getUrl($cat->redirect));
        }

        if (!$cat) {
            return $this->err404();
        }

        $this->view->addData(['page' => $cat, 'next' => $next]);

        return $this->render([
            'articles-' . $cat->content_type . '-' . $cat->type,
            'articles-' . $cat->content_type . '-' . $cat->slug,
            'articles-' . $cat->content_type . '-' . $cat->id,
            'articles-' . $cat->content_type,
            'articles-' . $cat->slug,
            'articles-' . $cat->id,
            'articles'
        ]);
    }
}
