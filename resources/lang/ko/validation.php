<?php

/**
 * The file downloaded from
 * https://github.com/caouecs/Laravel-lang/blob/master/ko/validation.php
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    'after_or_equal'       => ':attribute 은 :date 보다 빠르거나 같아야 합니다.',
    'before_or_equal'      => ':attribute 은 :date 보다 늦거나 같아야 합니다.',

    'accepted' => ':attribute을(를) 동의하지 않았습니다.',
    'active_url' => ':attribute 이 유효한 URL이 아닙니다.',
    'after' => ':attribute 이 :date 보다 이후 날짜가 아닙니다.',
    'alpha' => ':attribute 에 문자 외의 이 포함되어 있습니다.',
    'alpha_dash' => ':attribute 에 문자, 숫자, 대쉬(-) 외의 이 포함되어 있습니다.',
    'alpha_num' => ':attribute 에 문자와 숫자 외의 이 포함되어 있습니다.',
    'array' => ':attribute 이 유효한 목록 형식이 아닙니다.',
    'before' => ':attribute 이 :date 보다 이전 날짜가 아닙니다.',
    'between' => [
        'numeric' => ':attribute 이 :min ~ :max 을 벗어납니다.',
        'file' => ':attribute 이 :min ~ :max 킬로바이트를 벗어납니다.',
        'string' => ':attribute :min~:max 글자로 작성해주세요.',
        'array' => ':attribute 이 :min ~ :max 개를 벗어납니다.',
    ],
    'boolean' => ':attribute 이 true 또는 false 가 아닙니다.',
    'confirmed' => ':attribute 와 :attribute 확인 이 서로 다릅니다.',
    'date' => ':attribute 이 유효한 날짜가 아닙니다.',
    'date_format' => ':attribute :format 형식으로 작성해주세요.',
    'different' => ':attribute 이 :other은(는) 서로 다르지 않습니다.',
    'digits' => ':attribute 이 :digits 자릿수가 아닙니다.',
    'digits_between' => ':attribute 이 :min ~ :max 자릿수를 벗어납니다.',
    'distinct' => ':attribute 에 중복된 항목이 있습니다.',
    'email' => ':attribute 이 형식에 맞지 않습니다.',
    'exists' => ':attribute 에 해당하는 리소스가 존재하지 않습니다.',
    'filled' => ':attribute 은 필수 항목입니다.',
    'image' => ':attribute 이 이미지가 아닙니다.',
    'in' => ':attribute 이 유효하지 않습니다.',
    'in_array' => ':attribute 이 :other 필드의 요소가 아닙니다.',
    'integer' => ':attribute 이 정수가 아닙니다.',
    'ip' => ':attribute 이 유효한 IP 주소가 아닙니다.',
    'json' => ':attribute 이 유효한 JSON 문자열이 아닙니다.',
    'max' => [
        'numeric' => ':attribute 이 :max 보다 큽니다.',
        'file' => ':attribute 이 :max 킬로바이트보다 큽니다.',
        'string' => ':attribute 이 :max 글자보다 많습니다.',
        'array' => ':attribute 이 :max 개보다 많습니다.',
    ],
    'mimes' => ':attribute 이 :values 와(과) 다른 형식입니다.',
    'min' => [
        'numeric' => ':attribute이 :min 보다 작습니다.',
        'file' => ':attribute 이 :min 킬로바이트보다 작습니다.',
        'string' => ':attribute :min 글자 이상으로 작성하셔야합니다.',
        'array' => ':attribute 이 :max 개보다 적습니다.',
    ],
    'not_in' => ':attribute 이 유효하지 않습니다.',
    'numeric' => ':attribute 이 숫자가 아닙니다.',
    'present' => ':attribute 필드가 누락되었습니다.',
    'regex' => ':attribute 의 형식이 유효하지 않습니다.',
    'required' => ':attribute 필수 항목입니다.',
    'required_if' => ':attribute은 필수 항목입니다.',
    'required_unless' => ':attribute 필수항목 입니다.',
    'required_with' => ':attribute 필수입니다.',
    'required_with_all' => ':attribute 이 누락되었습니다 (:values 이 있을 때는 필수).',
    'required_without' => ':attribute 필수입니다.',
    'required_without_all' => ':attribute 이 누락되었습니다 (:values 이 없을 때는 필수).',
    'same' => ':attribute 이 :other 와 서로 다릅니다.',
    'size' => [
        'numeric' => ':attribute 이 :size 가 아닙니다.',
        'file' => ':attribute 이 :size 킬로바이트가 아닙니다.',
        'string' => ':attribute 이 :size 글자가 아닙니다.',
        'array' => ':attribute 이 :max 개가 아닙니다.',
    ],
    'string' => ':attribute 이 글자가 아닙니다.',
    'timezone' => ':attribute 이 올바른 시간대가 아닙니다.',
    'unique' => ':attribute 이미 사용중입니다.',
    'url' => ':attribute 이 유효한 URL이 아닙니다.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'birth' => [
            'date_format' => '생년월일을 8자리 형식으로 작성해주세요.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        'id' => '해당',

        'admins_id' => '관리자 정보',
        'title' => '제목',
        'content' => '내용',
        'type' => '유형',
        'is_blind' => '블라인드',

        'email' => '이메일',
        'password' => '비밀번호',
        'password_confirmation' => '비밀번호 확인',
        'new_password' => '새 비밀번호',
        'new_password_confirmation' => '새 비밀번호 확인',

        'name' => '이름',
        'phone' => '전화번호',
        'nickname' => '닉네임',

        'reply_content' => '답변',
        'tags' => '태그',
        'files' => '파일',
        'files.*' => '파일',

        'code' => '제품 ID',
        'price' => '가격',
        'context' => '상세설명',
        'admin_id' => '아이디',

        'target' => '타겟',

        'categoryTitle' => '카테고리 이름',
        'magazine_category_id' => '카테고리'
    ],
];
