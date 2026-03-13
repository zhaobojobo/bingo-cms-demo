<?php

return function (PDO $pdo) {
    $systemSettings = require __DIR__ . '/../settings/system.php';
    $sql = "SELECT * FROM bgo_setting WHERE setting_file='system'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $values = [];
    foreach ($rows as $row) {
        $values[$row['setting_name']] = $row['setting_value'];
    }
    $languagesValue = $systemSettings['LANGUAGE']['LANGUAGES']['value'];
    if (!empty($values['LANGUAGES'])) {
        $languagesValue = json_decode($values['LANGUAGES']);
    }

    $defaultLang = $systemSettings['LANGUAGE']['LANGUAGE_DEFAULT']['value'];
    if (!empty($values['LANGUAGE_DEFAULT'])) {
        $defaultLang = $values['LANGUAGE_DEFAULT'];
    }

    $languages = $systemSettings['LANGUAGE']['LANGUAGES']['options'];
    $languages = array_filter($languages, function ($k) use ($languagesValue) {
        return in_array($k, $languagesValue);
    }, ARRAY_FILTER_USE_KEY);

    return [
        'languages'   => $languages,
        'defaultLang' => $defaultLang
    ];
};
