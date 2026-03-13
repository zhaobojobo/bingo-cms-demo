# 數據匯出XLS

## 使用方法

只需要在控制器中調用以下代碼:

```php
$xls = new \App\DataToExcelSheet($data, $header);
$xls->setWidth('A', '20'); // 設置列寬度, 根據實際項目設置, 可省略
$xls->setWidth('B', '30'); // 設置列寬度, 根據實際項目設置, 可省略
$xls->setWidth('...', '?'); // 設置列寬度, 根據實際項目設置, 可省略
$xls->export($filename);
```

## 代碼詳解

### 1. 創建對象

```php
$xls = new \App\DataToExcelSheet($data, $header);
```
#### 參數說明:

$data 必須提供, 要匯出的數據, 例如:

```php
$data = [
    ['id' => 998, 'name' => '傑克', 'age' => 25, 'gender' => '男', ...],
    ['id' => 999, 'name' => '肉絲', 'age' => 25, 'gender' => '女', ...],
    ...
];
```

$header 可選參數, 用來指定 xls 文件第一行的標題, 如果神略, 則使用 $data 中的數據鍵代替, 例如:

```php
$header = ['id' => '編號', 'name' => '名稱', 'age' => '年齡', 'gender' => '性別', ...];
```

最終的數據轉換結果如下:
```php
$rows = [
    ['編號', '名稱', '年齡', '性別', ...],
    [998,   '傑克',  25,    '男', ...],
    [999,   '肉絲',  25,    '女', ...],
];
```

### 設置列寬度, 此操作可以省略, 默認最小寬度

```php
$xls->setWidth($column, $width);
```

#### 參數說明:

- $column, xls文件中的列名, 按照大寫英文字母排序: A, B, C, ...
- $width 列寛尺寸, 正整數字符串, 如: '10', '20', '30', ...

### 匯出

```php
$xls->export($filename);
```
#### 參數說明:

$filename, 匯出文件名, 如: members

**注意**: 爲保證文件正確打開, 指定文件名時不要帶擴展名, 匯出格式統一爲: .xlsx 格式
