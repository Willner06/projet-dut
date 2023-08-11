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

    'accepted'             => 'Le champ :attribute doit être accepté.',
    'active_url'           => 'Le champ :attribute n\'est pas une URL valide.',
    'after'                => 'Le champ :attribute doit être une date postérieure à :date.',
    'after_or_equal'       => 'Le champ :attribute doit être une date postérieure ou égale à :date.',
    'alpha'                => 'Le champ :attribute ne peut contenir que des lettres.',
    'alpha_dash'           => 'Le champ :attribute ne peut contenir que des lettres, des chiffres et des tirets.',
    'alpha_num'            => 'Le champ :attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => 'Le champ :attribute doit être un tableau.',
    'before'               => 'Le champ :attribute doit être une date antérieure à :date.',
    'before_or_equal'      => 'Le champ :attribute doit être une date antérieure ou égale à :date.',
    'between'              => [
        'numeric' => 'Le champ :attribute doit être compris entre :min et :max.',
        'file'    => 'Le champ :attribute doit être compris entre :min et :max kilo-octets.',
        'string'  => 'Le champ :attribute doit être compris entre :min et :max caractères.',
        'array'   => 'Le champ :attribute doit avoir entre :min et :max éléments.',
    ],
    'boolean'              => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed'            => 'Le champ :attribute ne correspond pas à la confirmation.',
    'current_password'     => 'Le mot de passe est incorrect.',
    'date'                 => 'Le champ :attribute n\'est pas une date valide.',
    'date_equals'          => 'Le champ :attribute doit être une date égale à :date.',
    'date_format'          => 'Le champ :attribute ne correspond pas au format :format.',
    'different'            => 'Le champ :attribute et :other doivent être différents.',
    'digits'               => 'Le champ :attribute doit contenir :digits chiffres.',
    'digits_between'       => 'Le champ :attribute doit contenir entre :min et :max chiffres.',
    'dimensions'           => 'Les dimensions de l\'image :attribute ne sont pas valides.',
    'distinct'             => 'Le champ :attribute a une valeur en double.',
    'email'                => 'Le champ :attribute doit être une adresse email valide.',
    'ends_with'            => 'Le champ :attribute doit se terminer par l\'une des valeurs suivantes : :values.',
    'exists'               => 'Le champ :attribute sélectionné n\'est pas valide.',
    'file'                 => 'Le champ :attribute doit être un fichier.',
    'filled'               => 'Le champ :attribute doit avoir une valeur.',
    "image"            => "Le champ :attribute doit être une image.",
    "in"               => "Le champ :attribute est invalide.",
    "integer"          => "Le champ :attribute doit être un entier.",
    "ip"               => "Le champ :attribute doit être une adresse IP valide.",
    "max"              => array(
        "numeric" => "La valeur de :attribute ne peut être supérieure à :max.",
        "file"    => "Le fichier :attribute ne peut être plus gros que :max kilobytes.",
        "string"  => "Le texte de :attribute ne peut contenir plus de :max caractères.",
    ),
    "mimes"            => "Le champ :attribute doit être un fichier de type : :values.",
    "min"              => array(
        "numeric" => "La valeur de :attribute doit être inférieure à :min.",
        "file"    => "Le fichier :attribute doit être plus que gros que :min kilobytes.",
        "string"  => "Le texte :attribute doit contenir au moins :min caractères.",
    ),
    "not_in"           => "Le champ :attribute sélectionné n'est pas valide.",
    "numeric"          => "Le champ :attribute doit contenir un nombre.",
    "regex"            => "Le format du champ :attribute est invalide.",
    "required"         => "Le champ :attribute est obligatoire.",
    "required_if"      => "Le champ :attribute est obligatoire quand la valeur de :other est :value.",
    "required_with"    => "Le champ :attribute est obligatoire quand :values est présent.",
    "required_without" => "Le champ :attribute est obligatoire quand :values n'est pas présent.",
    "same"             => "Les champs :attribute et :other doivent être identiques.",
    "size"             => array(
        "numeric" => "La taille de la valeur de :attribute doit être :size.",
        "file"    => "La taille du fichier de :attribute doit être de :size kilobytes.",
        "string"  => "Le texte de :attribute doit contenir :size caractères.",
    ),
    "unique"           => "La valeur du champ :attribute est déjà utilisée.",
    "url"              => "Le format de l'URL de :attribute n'est pas valide.",

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
