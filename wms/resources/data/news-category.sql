INSERT INTO `bgo_access` (`name`, `description`, `access_code`, `access_group`, `access_type`, `route`, `linkable`, `status`, `pid`, `sort`) VALUES
('Add', '', 'news-category-add', 'news-category', 1, '/catalog/edit/news/category', 1, 1, 27, 126),
('Edit', '', 'news-category-edit', 'news-category', 2, '/catalog/edit/news/category/{id}', 0, 1, 27, 127),
('Delete', '', 'news-category-delete', 'news-category', 4, '/catalog/delete', 0, 1, 27, 130),
('Disable Delete', '', 'news-category-delete-disable', 'news-category', 2, '/catalog/ban-delete/{id}', 0, 1, 27, 131),
('Disable Subcatalog', '', 'news-category-subcategory-disable', 'news-category', 2, '/catalog/ban-children/{id}', 0, 1, 27, 132),
('Assign Agencies', '', 'news-category-grant-agencies', 'news-category', 2, '/catalog/grant/agencies', 0, 1, 27, 123),
('Fields Manage', '', 'news-category-fields', 'news-category', 0, '/extend/category/news', 0, 1, 27, 133),
('Assign Reviewers', '', 'news-category-grant-reviewers', 'news-category', 2, '/catalog/grant/reviewer', 0, 1, 27, 124),
('Assign Editors', '', 'news-category-grant-editors', 'news-category', 2, '/catalog/grant/editors', 0, 1, 27, 125),
('Edit Name', '', 'news-category-name-edit', 'news-category', 2, '/catalog/name/update', 0, 1, 27, 128),
('Edit Slug', '', 'news-category-slug-edit', 'news-category', 2, '/catalog/slug/update', 0, 1, 27, 129);