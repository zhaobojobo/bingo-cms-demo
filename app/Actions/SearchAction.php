<?php


namespace Site\Actions;


use Site\Action;
use Site\Helper;

class SearchAction extends Action
{
    public function __invoke(): string
    {
        $q = Helper::get('q');
        $this->view->addData(['gets' => ['q' => $q]]);

        $page = [
            'title' => t('搜索 "%s"', [$q]),
            'seo_title' => t('Search results for "%s"', [$q]),
            'seo_description' => t('Search results for "%s"', [$q]),
            'seo_keywords' => $q,
        ];
        $this->view->addData(['page' => $page, 'q' => $q]);

        return $this->render(['search']);
    }
}
