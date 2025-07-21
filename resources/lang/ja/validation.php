<?php

return [

    /*
    |--------------------------------------------------------------------------
    | バリデーション言語行
    |--------------------------------------------------------------------------
    */

    'accepted'             => ':attributeを承認してください。',
    'active_url'           => ':attributeは有効なURLではありません。',
    'after'                => ':attributeには、:date以降の日付を指定してください。',
    'after_or_equal'       => ':attributeには、:date以降もしくは同日時を指定してください。',
    'alpha'                => ':attributeはアルファベットのみがご利用できます。',
    'alpha_dash'           => ':attributeはアルファベットとダッシュ(-)及び下線(_)がご利用できます。',
    'alpha_num'            => ':attributeはアルファベット数字がご利用できます。',
    'array'                => ':attributeは配列でなければなりません。',
    'before'               => ':attributeには、:date以前の日付を指定してください。',
    'before_or_equal'      => ':attributeには、:date以前もしくは同日時を指定してください。',
    'between'              => [
        'numeric' => ':attributeは、:minから:maxの間で指定してください。',
        'file'    => ':attributeは、:min KBから:max KBの間で指定してください。',
        'string'  => ':attributeは、:min文字から:max文字の間で指定してください。',
        'array'   => ':attributeは、:min個から:max個の間で指定してください。',
    ],
    'boolean'              => ':attributeは、trueかfalseを指定してください。',
    'confirmed'            => ':attributeと確認フィールドが一致しません。',
    'date'                 => ':attributeは有効な日付ではありません。',
    'date_format'          => ':attributeの形式は、":format"と一致していません。',
    'different'            => ':attributeと:otherには異なるものを指定してください。',
    'digits'               => ':attributeは:digits桁で指定してください。',
    'digits_between'       => ':attributeは:min桁から:max桁で指定してください。',
    'dimensions'           => ':attributeの画像サイズが無効です。',
    'distinct'             => ':attributeの値が重複しています。',
    'email'                => ':attributeは有効なメールアドレス形式で指定してください。',
    'exists'               => '選択された:attributeは存在しません。',
    'file'                 => ':attributeはファイルでなければなりません。',
    'filled'               => ':attributeは必須です。',
    'gt'                   => [
        'numeric' => ':attributeは、:valueより大きくなければなりません。',
        'file'    => ':attributeは、:value KBより大きくなければなりません。',
        'string'  => ':attributeは、:value文字より長くなければなりません。',
        'array'   => ':attributeは、:value個より多くなければなりません。',
    ],
    'gte'                  => [
        'numeric' => ':attributeは、:value以上でなければなりません。',
        'file'    => ':attributeは、:value KB以上でなければなりません。',
        'string'  => ':attributeは、:value文字以上でなければなりません。',
        'array'   => ':attributeは、:value個以上でなければなりません。',
    ],
    'image'                => ':attributeは画像でなければなりません。',
    'in'                   => '選択された:attributeは無効です。',
    'in_array'             => ':attributeは:otherに存在しません。',
    'integer'              => ':attributeは整数でなければなりません。',
    'ip'                   => ':attributeは有効なIPアドレスでなければなりません。',
    'ipv4'                 => ':attributeは有効なIPv4アドレスでなければなりません。',
    'ipv6'                 => ':attributeは有効なIPv6アドレスでなければなりません。',
    'json'                 => ':attributeは有効なJSON文字列でなければなりません。',
    'lt'                   => [
        'numeric' => ':attributeは、:valueより小さくなければなりません。',
        'file'    => ':attributeは、:value KBより小さくなければなりません。',
        'string'  => ':attributeは、:value文字より短くなければなりません。',
        'array'   => ':attributeは、:value個より少なくなければなりません。',
    ],
    'lte'                  => [
        'numeric' => ':attributeは、:value以下でなければなりません。',
        'file'    => ':attributeは、:value KB以下でなければなりません。',
        'string'  => ':attributeは、:value文字以下でなければなりません。',
        'array'   => ':attributeは、:value個以下でなければなりません。',
    ],
    'max'                  => [
        'numeric' => ':attributeは:max以下でなければなりません。',
        'file'    => ':attributeは:max KB以下でなければなりません。',
        'string'  => ':attributeは:max文字以下でなければなりません。',
        'array'   => ':attributeは:max個以下でなければなりません。',
    ],
    'mimes'                => ':attributeは:valuesタイプのファイルでなければなりません。',
    'mimetypes'            => ':attributeは:valuesタイプのファイルでなければなりません。',
    'min'                  => [
        'numeric' => ':attributeは:min以上でなければなりません。',
        'file'    => ':attributeは:min KB以上でなければなりません。',
        'string'  => ':attributeは:min文字以上でなければなりません。',
        'array'   => ':attributeは:min個以上でなければなりません。',
    ],
    'not_in'               => '選択された:attributeは無効です。',
    'not_regex'            => ':attributeの形式が正しくありません。',
    'numeric'              => ':attributeは数字でなければなりません。',
    'present'              => ':attributeが存在している必要があります。',
    'regex'                => ':attributeの形式が正しくありません。',
    'required'             => ':attributeは必須です。',
    'required_if'          => ':attributeは:otherが:valueの場合に必須です。',
    'required_unless'      => ':attributeは:otherが:valuesでない場合に必須です。',
    'required_with'        => ':attributeは:valuesが存在する場合に必須です。',
    'required_with_all'    => ':attributeは:valuesがすべて存在する場合に必須です。',
    'required_without'     => ':attributeは:valuesが存在しない場合に必須です。',
    'required_without_all' => ':attributeは:valuesがすべて存在しない場合に必須です。',
    'same'                 => ':attributeと:otherが一致しません。',
    'size'                 => [
        'numeric' => ':attributeは:sizeでなければなりません。',
        'file'    => ':attributeは:size KBでなければなりません。',
        'string'  => ':attributeは:size文字でなければなりません。',
        'array'   => ':attributeは:size個でなければなりません。',
    ],
    'string'               => ':attributeは文字列でなければなりません。',
    'timezone'             => ':attributeは有効なタイムゾーンでなければなりません。',
    'unique'               => ':attributeの値は既に存在しています。',
    'uploaded'             => ':attributeのアップロードに失敗しました。',
    'url'                  => ':attributeは有効なURL形式でなければなりません。',

    /*
    |--------------------------------------------------------------------------
    | 属性名
    |--------------------------------------------------------------------------
    |
    | 以下の値はエラーメッセージ内のプレースホルダー :attribute の置き換えに使われます。
    | 例えば "email" は "メールアドレス" に置き換えられます。
    |
    */

    'attributes' => [
        'over_name' => '名字',
        'under_name' => '名前',
        'mail_address' => 'メールアドレス',
        'birth_day' => '生年月日',
        'password_confirmation' => 'パスワード確認',
        'password' => 'パスワード',
        'sub_category' => 'サブカテゴリー名',
        'over_name_kana' => '名字カナ',
        'under_name_kana' => '名前カナ',
        'main_category_name' => 'メインカテゴリー名',
        'comment' => 'コメント'
    ],

];
