<?php


namespace Site;

use League\Plates\Engine;
use League\Plates\Template\Template;

abstract class Action
{

    protected Engine $view;

    protected string $lang;

    public function __construct(Engine $view, string $lang)
    {
        $this->lang = $lang;
        $this->view = $view;
        $data = [
            'lang' => $this->lang,
            'page' => [],
        ];
        $this->view->addData($data);
    }

    public function err404(): string
    {
        http_response_code(404);
        $template = new Template($this->view, '404');
        try {
            return $template->render();
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function assign($data, string $template = null): void
    {
        $this->view->addData($data, $template);
    }

    public function success($data = [], $message = '', $location = '')
    {
        return json_encode(
            [
                'status' => true,
                'data' => $data,
                'message' => $message,
                'location' => $location,
            ]
        );
    }

    public function error($message, $errors = [])
    {
        return json_encode(['status' => false, 'message' => $message, 'errors' => $errors]);
    }

    public function redirect($url): void
    {
        header('Location: ' . $url);
        exit;
    }

    public function render($views): string
    {
        $template = false;
        foreach ($views as $view) {
            if ($this->view->exists($view)) {
                $template = new Template($this->view, $view);
                break;
            }
        }

        if (!$template) {
            return 'Template file is not found!';
        }

        try {
            return $template->render();
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}
