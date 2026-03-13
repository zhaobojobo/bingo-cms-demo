<?php


namespace Site\Actions;


use Site\Action;
use Site\Models\Post;

class ArticleAction extends Action
{
    public function __invoke($id): string
    {
        $model = new Post();
        if (is_numeric($id)) {
            $post = $model->find($id);
        } else {
            $post = $model->findSlug($id);
        }
        if (!$post || $post['hidden']) {
            return $this->err404();
        }

        if (!$post['review']) {
            if ($cache = $model->getCache($post['id'])) {
                $post = $cache;
            }
        }

        $this->view->addData(['page' => $post]);

        return $this->render([
            'article-' . $post->type,
            'article-' . $post->cat,
            'article'
        ]);
    }
}
