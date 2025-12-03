<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute qəbul edilməlidir.',
    'accepted_if' => ':other :value olduqda :attribute qəbul edilməlidir.',
    'active_url' => ':attribute düzgün URL olmalıdır.',
    'after' => ':attribute :date tarixindən sonra olmalıdır.',
    'after_or_equal' => ':attribute :date tarixinə bərabər və ya sonra olmalıdır.',
    'alpha' => ':attribute yalnız hərflərdən ibarət olmalıdır.',
    'alpha_dash' => ':attribute yalnız hərflər, rəqəmlər, tire və alt xətt simvollarından ibarət ola bilər.',
    'alpha_num' => ':attribute yalnız hərflər və rəqəmlərdən ibarət olmalıdır.',
    'any_of' => ':attribute etibarsızdır.',
    'array' => ':attribute massiv olmalıdır.',
    'ascii' => ':attribute yalnız ASCII simvollarından ibarət olmalıdır.',
    'before' => ':attribute :date tarixindən əvvəl olmalıdır.',
    'before_or_equal' => ':attribute :date tarixinə bərabər və ya əvvəl olmalıdır.',
    'between' => [
        'array' => ':attribute :min və :max arasında element sayına malik olmalıdır.',
        'file' => ':attribute :min və :max kilobayt arasında olmalıdır.',
        'numeric' => ':attribute :min və :max arasında olmalıdır.',
        'string' => ':attribute :min və :max simvol arasında olmalıdır.',
    ],
    'boolean' => ':attribute true və ya false olmalıdır.',
    'can' => ':attribute icazəsiz dəyər ehtiva edir.',
    'confirmed' => ':attribute təsdiqi uyğun gəlmir.',
    'contains' => ':attribute tələb olunan dəyəri ehtiva etmir.',
    'current_password' => 'Şifrə yanlışdır.',
    'date' => ':attribute düzgün tarix olmalıdır.',
    'date_equals' => ':attribute :date tarixinə bərabər olmalıdır.',
    'date_format' => ':attribute :format formatında olmalıdır.',
    'decimal' => ':attribute :decimal onluq rəqəmə malik olmalıdır.',
    'declined' => ':attribute rədd edilməlidir.',
    'declined_if' => ':other :value olduqda :attribute rədd edilməlidir.',
    'different' => ':attribute və :other fərqli olmalıdır.',
    'digits' => ':attribute :digits rəqəmdən ibarət olmalıdır.',
    'digits_between' => ':attribute :min və :max rəqəm arasında olmalıdır.',
    'dimensions' => ':attribute şəklin ölçüləri uyğun deyil.',
    'distinct' => ':attribute təkrarlanan dəyər ehtiva edir.',
    'doesnt_contain' => ':attribute aşağıdakılardan heç birini ehtiva etməməlidir: :values.',
    'doesnt_end_with' => ':attribute aşağıdakılardan heç biri ilə bitməməlidir: :values.',
    'doesnt_start_with' => ':attribute aşağıdakılardan heç biri ilə başlamamalıdır: :values.',
    'email' => ':attribute düzgün email ünvanı olmalıdır.',
    'ends_with' => ':attribute aşağıdakılardan biri ilə bitməlidir: :values.',
    'enum' => 'Seçilmiş :attribute etibarsızdır.',
    'exists' => 'Seçilmiş :attribute etibarsızdır.',
    'extensions' => ':attribute aşağıdakı uzantılardan birinə malik olmalıdır: :values.',
    'file' => ':attribute fayl olmalıdır.',
    'filled' => ':attribute doldurulmalıdır.',
    'gt' => [
        'array' => ':attribute :value elementdən çox olmalıdır.',
        'file' => ':attribute :value kilobaytdan böyük olmalıdır.',
        'numeric' => ':attribute :value dəyərindən böyük olmalıdır.',
        'string' => ':attribute :value simvoldan çox olmalıdır.',
    ],
    'gte' => [
        'array' => ':attribute ən azı :value element olmalıdır.',
        'file' => ':attribute ən azı :value kilobayt olmalıdır.',
        'numeric' => ':attribute ən azı :value olmalıdır.',
        'string' => ':attribute ən azı :value simvol olmalıdır.',
    ],
    'hex_color' => ':attribute düzgün hexadecimal rəng olmalıdır.',
    'image' => ':attribute şəkil olmalıdır.',
    'in' => 'Seçilmiş :attribute etibarsızdır.',
    'in_array' => ':attribute :other daxilində mövcud olmalıdır.',
    'in_array_keys' => ':attribute aşağıdakılardan ən azı birini ehtiva etməlidir: :values.',
    'integer' => ':attribute tam ədəd olmalıdır.',
    'ip' => ':attribute düzgün IP ünvanı olmalıdır.',
    'ipv4' => ':attribute düzgün IPv4 ünvanı olmalıdır.',
    'ipv6' => ':attribute düzgün IPv6 ünvanı olmalıdır.',
    'json' => ':attribute düzgün JSON formatında olmalıdır.',
    'list' => ':attribute siyahı olmalıdır.',
    'lowercase' => ':attribute kiçik hərflərlə yazılmalıdır.',
    'lt' => [
        'array' => ':attribute :value elementdən az olmalıdır.',
        'file' => ':attribute :value kilobaytdan kiçik olmalıdır.',
        'numeric' => ':attribute :value dəyərindən kiçik olmalıdır.',
        'string' => ':attribute :value simvoldan az olmalıdır.',
    ],
    'lte' => [
        'array' => ':attribute maksimum :value element ola bilər.',
        'file' => ':attribute maksimum :value kilobayt ola bilər.',
        'numeric' => ':attribute maksimum :value ola bilər.',
        'string' => ':attribute maksimum :value simvol ola bilər.',
    ],
    'mac_address' => ':attribute düzgün MAC ünvanı olmalıdır.',
    'max' => [
        'array' => ':attribute maksimum :max element ola bilər.',
        'file' => ':attribute maksimum :max kilobayt ola bilər.',
        'numeric' => ':attribute maksimum :max ola bilər.',
        'string' => ':attribute maksimum :max simvol ola bilər.',
    ],
    'max_digits' => ':attribute maksimum :max rəqəm ola bilər.',
    'mimes' => ':attribute aşağıdakı fayl tipində olmalıdır: :values.',
    'mimetypes' => ':attribute aşağıdakı fayl tipində olmalıdır: :values.',
    'min' => [
        'array' => ':attribute ən azı :min element olmalıdır.',
        'file' => ':attribute ən azı :min kilobayt olmalıdır.',
        'numeric' => ':attribute ən azı :min olmalıdır.',
        'string' => ':attribute ən azı :min simvol olmalıdır.',
    ],
    'min_digits' => ':attribute ən azı :min rəqəm olmalıdır.',
    'missing' => ':attribute olmamalıdır.',
    'missing_if' => ':other :value olduqda :attribute olmamalıdır.',
    'missing_unless' => ':other :value olmadıqda :attribute olmamalıdır.',
    'missing_with' => ':values mövcud olduqda :attribute olmamalıdır.',
    'missing_with_all' => ':values mövcud olduqda :attribute olmamalıdır.',
    'multiple_of' => ':attribute :value ədədinə bölünən olmalıdır.',
    'not_in' => 'Seçilmiş :attribute etibarsızdır.',
    'not_regex' => ':attribute formatı etibarsızdır.',
    'numeric' => ':attribute rəqəm olmalıdır.',
    'password' => [
        'letters' => ':attribute ən azı bir hərf ehtiva etməlidir.',
        'mixed' => ':attribute ən azı bir böyük və bir kiçik hərf ehtiva etməlidir.',
        'numbers' => ':attribute ən azı bir rəqəm ehtiva etməlidir.',
        'symbols' => ':attribute ən azı bir simvol ehtiva etməlidir.',
        'uncompromised' => 'Bu :attribute məlumat sızması bazasında aşkar edilib. Xahiş edirik başqa :attribute seçin.',
    ],
    'present' => ':attribute mövcud olmalıdır.',
    'present_if' => ':other :value olduqda :attribute mövcud olmalıdır.',
    'present_unless' => ':other :value olmadıqda :attribute mövcud olmalıdır.',
    'present_with' => ':values mövcud olduqda :attribute mövcud olmalıdır.',
    'present_with_all' => ':values mövcud olduqda :attribute mövcud olmalıdır.',
    'prohibited' => ':attribute qadağandır.',
    'prohibited_if' => ':other :value olduqda :attribute qadağandır.',
    'prohibited_if_accepted' => ':other qəbul edildikdə :attribute qadağandır.',
    'prohibited_if_declined' => ':other rədd edildikdə :attribute qadağandır.',
    'prohibited_unless' => ':other :values dəyərlərindən biri olmadıqda :attribute qadağandır.',
    'prohibits' => ':attribute mövcud olduqda :other qadağandır.',
    'regex' => ':attribute formatı etibarsızdır.',
    'required' => ':attribute tələb olunur.',
    'required_array_keys' => ':attribute aşağıdakıları ehtiva etməlidir: :values.',
    'required_if' => ':other :value olduqda :attribute tələb olunur.',
    'required_if_accepted' => ':other qəbul edildikdə :attribute tələb olunur.',
    'required_if_declined' => ':other rədd edildikdə :attribute tələb olunur.',
    'required_unless' => ':other :values dəyərlərindən biri olmadıqda :attribute tələb olunur.',
    'required_with' => ':values mövcud olduqda :attribute tələb olunur.',
    'required_with_all' => ':values mövcud olduqda :attribute tələb olunur.',
    'required_without' => ':values mövcud olmadıqda :attribute tələb olunur.',
    'required_without_all' => ':values heç biri mövcud olmadıqda :attribute tələb olunur.',
    'same' => ':attribute və :other uyğun olmalıdır.',
    'size' => [
        'array' => ':attribute :size element ehtiva etməlidir.',
        'file' => ':attribute :size kilobayt olmalıdır.',
        'numeric' => ':attribute :size olmalıdır.',
        'string' => ':attribute :size simvol olmalıdır.',
    ],
    'starts_with' => ':attribute aşağıdakılardan biri ilə başlamalıdır: :values.',
    'string' => ':attribute mətn olmalıdır.',
    'timezone' => ':attribute düzgün saat qurşağı olmalıdır.',
    'unique' => ':attribute artıq istifadə olunub.',
    'uploaded' => ':attribute yüklənə bilmədi.',
    'uppercase' => ':attribute böyük hərflərlə yazılmalıdır.',
    'url' => ':attribute düzgün URL olmalıdır.',
    'ulid' => ':attribute düzgün ULID olmalıdır.',
    'uuid' => ':attribute düzgün UUID olmalıdır.',

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
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'ad',
        'email' => 'email',
        'password' => 'şifrə',
        'password_confirmation' => 'şifrə təsdiqi',
        'phone' => 'telefon',
        'address' => 'ünvan',
        'city' => 'şəhər',
        'country' => 'ölkə',
        'title' => 'başlıq',
        'description' => 'təsvir',
        'status' => 'status',
        'due_date' => 'bitmə tarixi',
        'start_date' => 'başlama tarixi',
        'first_name' => 'ad',
        'last_name' => 'soyad',
        'birth_date' => 'doğum tarixi',
        'image' => 'şəkil',
        'avatar' => 'avatar',
        'file' => 'fayl',
        'roles' => 'rollar',
        'permissions' => 'icazələr',
    ],

];
