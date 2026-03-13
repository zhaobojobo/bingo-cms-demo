# Bingo CMS

Bingo 網站管理系統

## 版本信息

最后更新日期： 2024/03/21

## 安全編碼要求

請勿在代碼中直接引用 `$_GET`, `$_POST`，通過以下方式訪問

- $_GET['參數名']: Helper:get(參數名，默認值)
- $_POST['參數名']: Helper:get(參數名，默認值)

自定義SQL查詢請使用PDO預處理語句及慘素綁定方式，禁止將參數值直接拼接在SQL中

參考文檔：

- https://www.php.net/manual/zh/pdo.prepare.php
- https://www.php.net/manual/zh/pdostatement.execute.php
