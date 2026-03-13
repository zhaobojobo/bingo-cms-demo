<?php

namespace Site\Actions;

use Site\Action;
use Site\Models\Front;

class FrontAction extends Action
{
    public function __invoke($path)
    {
        $model = new Front();
        $type = $model->getType($path);

        switch ($type) {
            case 'page':
                $action = new PageAction($this->view, $this->lang);
                break;
            case 'catalog':
                $action = new ArticlesAction($this->view, $this->lang);
                break;
            case 'article':
                $action = new ArticleAction($this->view, $this->lang);
                break;
            default:
                return $this->err404();
        }

        return $action($model->getId($path));
    }
}
