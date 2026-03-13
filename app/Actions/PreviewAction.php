<?php


namespace Site\Actions;


use Site\Action;
use Site\Models\Page;
use Site\Models\Post;

class PreviewAction extends Action
{
    public function __invoke($type, $id): string
    {
        if (!isset($_COOKIE['PREVIEW_KEY']) || !isset($_GET['key'])) {
            return $this->err404();
        }
        if ($_COOKIE['PREVIEW_KEY'] != $_GET['key']) {
            return $this->err404();
        }

        if ($type == 'page') {
            $model = new Page();
            if (is_numeric($id)) {
                $page = $model->find($id);
            } else {
                $page = $model->findSlug($id);
            }
            $this->view->addData(['page' => $page]);
            $views = [
                'page-' . $page->slug ?: $page->id,
                'page'
            ];
            if ($page->id == 1) {
                $views = ['index'];
            }
            return $this->render($views);
        } elseif ($type == 'post') {
            $model = new Post();
            if (is_numeric($id)) {
                $post = $model->find($id);
            } else {
                $post = $model->findSlug($id);
            }
            $this->view->addData(['page' => $post]);
            $views = [
                'article-' . $post->cat,
                'article-' . $post->type,
                'article'
            ];
            return $this->render($views);
        }

        return $this->err404();
    }
}
