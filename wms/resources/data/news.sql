INSERT INTO `bgo_access` (`name`, `description`, `access_code`, `access_group`, `access_type`, `route`, `linkable`, `status`, `pid`, `sort`) VALUES
('Add', '', 'news-add', 'news', 1, '/post/edit/news/', 1, 1, 28, 109),
('Edit', '', 'news-edit', 'news', 2, '/post/edit/news/{id}', 0, 1, 28, 110),
('Delete', '', 'news-delete', 'news', 4, '/post/delete/news', 0, 1, 28, 115),
('Review', '', 'news-review', 'news', 2, '/post/review/update/{id}', 0, 1, 28, 114),
('Hidden', '', 'news-hidden', 'news', 2, '/post/hidden/update/{id}', 0, 1, 28, 119),
('Preview', '', 'news-preview', 'news', 3, '/post/preview/{id}', 0, 1, 28, 113),
('Edit Title', '', 'news-title-edit', 'news', 2, '/post/title/update', 0, 1, 28, 111),
('Edit Slug', '', 'news-slug-edit', 'news', 2, '/post/slug/update', 0, 1, 28, 112),
('Fields Manage', '', 'news-fields', 'news', 0, '/extend/post/news', 0, 1, 28, 121),
('Copy', '', 'news-copy', 'news', 3, '/post/copy/news/{id}', 0, 1, 28, 117),
('Batch Copy', '', 'news-batch-copy', 'news', 3, '/post/batch/copy/news', 0, 1, 28, 118),
('Batch Delete', '', 'news-batch-delete', 'news', 4, '/post/batch/delete/news', 0, 1, 28, 116),
('Export', '', 'news-export', 'news', 3, '/post/export/news', 1, 1, 28, 120);