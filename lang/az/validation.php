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
    'extensions' => ':attribute aşağıdakı genişləmələrdən birinə malik olmalıdır: :values.',
    'file' => ':attribute fayl olmalıdır.',
    'filled' => ':attribute doldurulmalıdır.',
    'gt' => [
        'array' => ':attribute :value elementdən çox olmalıdır.',
        'file' => ':attribute :value kilobaytdan böyük olmalıdır.',
        'numeric' => ':attribute :value-dən böyük olmalıdır.',
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
    'in_array' => ':attribute :other-də mövcud olmalıdır.',
    'in_array_keys' => ':attribute aşağıdakı açarlardan ən azı birini ehtiva etməlidir: :values.',
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
        'numeric' => ':attribute :value-dən kiçik olmalıdır.',
        'string' => ':attribute :value simvoldan az olmalıdır.',
    ],
    'lte' => [
        'array' => ':attribute maksimum :value element ola bilər.',
        'file' => ':attribute maksimum :value kilobayt ola bilər.',
        'numeric' => ':attribute maksimum :value ola bilər.',
        'string' => ':attribute maksimum :value simvol ola bilər.',
    ],
    'mac_address' => 'The :attribute field must be a valid MAC address.',
    'max' => [
        'array' => 'The :attribute field must not have more than :max items.',
        'file' => 'The :attribute field must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute field must not be greater than :max.',
        'string' => 'The :attribute field must not be greater than :max characters.',
    ],
    'max_digits' => 'The :attribute field must not have more than :max digits.',
    'mimes' => 'The :attribute field must be a file of type: :values.',
    'mimetypes' => 'The :attribute field must be a file of type: :values.',
    'min' => [
        'array' => 'The :attribute field must have at least :min items.',
        'file' => 'The :attribute field must be at least :min kilobytes.',
        'numeric' => 'The :attribute field must be at least :min.',
        'string' => 'The :attribute field must be at least :min characters.',
    ],
    'min_digits' => 'The :attribute field must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'multiple_of' => 'The :attribute field must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute field format is invalid.',
    'numeric' => 'The :attribute field must be a number.',
    'password' => [
        'letters' => 'The :attribute field must contain at least one letter.',
        'mixed' => 'The :attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute field must contain at least one number.',
        'symbols' => 'The :attribute field must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'present_if' => 'The :attribute field must be present when :other is :value.',
    'present_unless' => 'The :attribute field must be present unless :other is :value.',
    'present_with' => 'The :attribute field must be present when :values is present.',
    'present_with_all' => 'The :attribute field must be present when :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_if_accepted' => 'The :attribute field is prohibited when :other is accepted.',
    'prohibited_if_declined' => 'The :attribute field is prohibited when :other is declined.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute field format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_if_declined' => 'The :attribute field is required when :other is declined.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute field must match :other.',
    'size' => [
        'array' => 'The :attribute field must contain :size items.',
        'file' => 'The :attribute field must be :size kilobytes.',
        'numeric' => 'The :attribute field must be :size.',
        'string' => 'The :attribute field must be :size characters.',
    ],
    'starts_with' => 'The :attribute field must start with one of the following: :values.',
    'string' => 'The :attribute field must be a string.',
    'timezone' => 'The :attribute field must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'uppercase' => 'The :attribute field must be uppercase.',
    'url' => 'The :attribute field must be a valid URL.',
    'ulid' => 'The :attribute field must be a valid ULID.',
    'uuid' => 'The :attribute field must be a valid UUID.',

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

    'attributes' => [],

];
