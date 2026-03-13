<?php

namespace Admin\Controller;

use Admin\Helper;
use App\Register;
use App\Domain\Slideshow\SlideWriter;
use App\Domain\Slideshow\SlideReader;
use App\Domain\Slideshow\SlideshowReader;
use App\Domain\Slideshow\SlideshowWriter;
use App\Domain\Slideshow\SlideReadRepository;
use App\Domain\Slideshow\SlideWriteRepository;
use App\Domain\Slideshow\SlideshowReadRepository;
use App\Domain\Slideshow\SlideshowWriteRepository;

class SlideshowController
{
    public function __construct()
    {
    }

    public function index()
    {
        $container = Register::get('container');
        $pdo       = Helper::getPdo($container['config']['db']);

        $repository = new SlideReadRepository($pdo);
        $finder     = new SlideReader($repository);
        $repository = new SlideshowReadRepository($pdo);
        $finder     = new SlideshowReader($repository, $finder);
        $rows       = $finder->findAll();

        var_dump($rows);
    }

    public function find($id)
    {
        $container = Register::get('container');
        $pdo       = Helper::getPdo($container['config']['db']);

        $repository = new SlideReadRepository($pdo);
        $finder     = new SlideReader($repository);
        $repository = new SlideshowReadRepository($pdo);
        $finder     = new SlideshowReader($repository, $finder);
        $row        = $finder->find($id);

        var_dump($row);
    }

    public function add()
    {
    }

    public function create()
    {
        $post = Helper::post();
        // $post = [
        //     'lang'        => 'zh-HK',
        //     'slug'        => 'home-slideshow',
        //     'name'        => 'Home Slideshow',
        //     'review'      => 0,
        //     'create_time' => date('Y-m-d H:i:s', time()),
        //     'update_time' => '0001-01-01 01:01:01',
        // ];

        $container = Register::get('container');
        $pdo       = Helper::getPdo($container['config']['db']);

        $repository = new SlideshowWriteRepository($pdo);
        $writer     = new SlideshowWriter($repository);

        $result = $writer->create($post);

        var_dump($result);
    }

    public function createSlide()
    {
        $post = Helper::post();
        // $post = [
        //     'lang'        => 'zh-HK',
        //     'slug'        => 'home-slideshow',
        //     'name'        => 'Home Slideshow',
        //     'review'      => 0,
        //     'create_time' => date('Y-m-d H:i:s', time()),
        //     'update_time' => '0001-01-01 01:01:01',
        // ];

        $container = Register::get('container');
        $pdo       = Helper::getPdo($container['config']['db']);

        $repository = new SlideWriteRepository($pdo);
        $writer     = new SlideWriter($repository);

        $result = $writer->create($post);

        var_dump($result);
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}