<?php

$params = [];

$params['post_types']    = ['article', 'news', 'product', 'project'];
$params['catalog_types'] = ['category', 'news.category', 'product.category', 'project.category', 'author'];

$params['model_groups'] = [
    'page'           => 'Page',
    'category'       => 'Category',
    'news'           => 'News',
    'product'        => 'Product',
    'setting'        => 'Setting',
    'block_list'     => 'List Data',
    'block_fragment' => 'Fragment Data',
    'album'          => 'Album',
    'activity'       => 'Activity',
    'photo'          => 'Photo',
    'post'           => 'Post',
    'list-item'      => 'List Item',
];

$params['input_types'] = [
    'input'           => 'Single Line Text',
    'textarea'        => 'Multiline Text',
    'textarea.editor' => 'Rich Text',
    'file'            => 'File',
    'image'           => 'Image',
    'images'          => 'Images',
    'video'           => 'Video',
    'input.number'    => 'Number',
    'input.email'     => 'Email',
    'input.url'       => 'Url',
    'input.datetime'  => 'Year-Month-Day Hour:Month:Second',
    'input.date'      => 'Year-Month-Day',
    'input.time'      => 'Hour:Month:Second',
    'input.color'     => 'Color',
    'input.checkbox'  => 'Multiple Choice Button',
    'list'            => 'List',
];

$params['front_input_types'] = [
    'input'          => 'Single Line Text',
    'textarea'       => 'Multiline Text',
    'file'           => 'File Upload',
    'input.number'   => 'Input:Number',
    'input.email'    => 'Input:Email',
    'input.url'      => 'Input:Url',
    'input.datetime' => 'Year-Month-Day Hour:Month:Second',
    'input.date'     => 'Year-Month-Day',
    'input.time'     => 'Hour:Month:Second',
    'input.checkbox' => 'Multiple Choice Button',
];

$params['nav_types'] = [
    'group'     => 'Group',
    'page'      => 'Page',
    'catalog'   => 'Catalog',
    'customize' => 'Customize',
];

$params['captcha_types'] = [
    'null'   => 'Null',
    'an'     => 'Alpha and Numeric',
    'grc_v2' => 'reCaptcha v2',
    'grc_v3' => 'reCaptcha v3',
];

$params['field_cols'] = [
    '12' => 12,
    '10' => 10,
    '9'  => 9,
    '8'  => 8,
    '6'  => 6,
    '4'  => 4,
    '3'  => 3,
    '2'  => 2,
];

return $params;
