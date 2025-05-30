<?php

return [
    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute não é uma URL válida.',
    'after'                => 'O campo :attribute deve ser uma data após :date.',
    'after_or_equal'       => 'O campo :attribute deve ser uma data igual ou posterior a :date.',
    'alpha'                => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O campo :attribute deve conter apenas letras, números e traços.',
    'alpha_num'            => 'O campo :attribute deve conter apenas letras e números.',
    'array'                => 'O campo :attribute deve ser um array.',
    'before'               => 'O campo :attribute deve ser uma data antes de :date.',
    'before_or_equal'      => 'O campo :attribute deve ser uma data igual ou anterior a :date.',
    'between'              => [
        'numeric' => 'O valor de :attribute deve estar entre :min e :max.',
        'file'    => 'O arquivo :attribute deve ter entre :min e :max kilobytes.',
        'string'  => 'O campo :attribute deve ter entre :min e :max caracteres.',
        'array'   => 'O campo :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação de :attribute não corresponde.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_equals'          => 'O campo :attribute deve ser uma data igual a :date.',
    'date_format'          => 'O campo :attribute não corresponde ao formato de data :format.',
    'different'            => 'Os campos :attribute e :other devem ser diferentes.',
    'digits'               => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O campo :attribute tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo :attribute contém um valor duplicado.',
    'email'                => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'ends_with'            => 'O campo :attribute deve terminar com um dos seguintes: :values.',
    'exists'               => 'O campo :attribute selecionado é inválido.',
    'file'                 => 'O campo :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute deve ter um valor.',
    'gt'                   => [
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'file'    => 'O arquivo :attribute deve ser maior que :value kilobytes.',
        'string'  => 'O campo :attribute deve ter mais de :value caracteres.',
        'array'   => 'O campo :attribute deve ter mais de :value itens.',
    ],
    'gte'                  => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'file'    => 'O arquivo :attribute deve ser maior ou igual a :value kilobytes.',
        'string'  => 'O campo :attribute deve ter :value caracteres ou mais.',
        'array'   => 'O campo :attribute deve ter :value itens ou mais.',
    ],
    'image'                => 'O campo :attribute deve ser uma imagem.',
    'in'                   => 'O campo :attribute selecionado é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute deve ser um número inteiro.',
    'ip'                   => 'O campo :attribute deve ser um endereço IP válido.',
    'ipv4'                 => 'O campo :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O campo :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O campo :attribute deve ser uma string JSON válida.',
    'lt'                   => [
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'file'    => 'O arquivo :attribute deve ser menor que :value kilobytes.',
        'string'  => 'O campo :attribute deve ter menos de :value caracteres.',
        'array'   => 'O campo :attribute deve ter menos de :value itens.',
    ],
    'lte'                  => [
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
        'file'    => 'O arquivo :attribute deve ser menor ou igual a :value kilobytes.',
        'string'  => 'O campo :attribute deve ter :value caracteres ou menos.',
        'array'   => 'O campo :attribute deve ter :value itens ou menos.',
    ],
    'max'                  => [
        'numeric' => 'O valor de :attribute não pode ser maior que :max.',
        'file'    => 'O arquivo :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'O campo :attribute não pode ter mais que :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais que :max itens.',
    ],
    'mimes'                => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'           => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O valor de :attribute deve ser no mínimo :min.',
        'file'    => 'O arquivo :attribute deve ter no mínimo :min kilobytes.',
        'string'  => 'O campo :attribute deve ter no mínimo :min caracteres.',
        'array'   => 'O campo :attribute deve ter no mínimo :min itens.',
    ],
    'not_in'               => 'O campo :attribute selecionado é inválido.',
    'not_regex'            => 'O formato do campo :attribute é inválido.',
    'numeric'              => 'O campo :attribute deve ser um número.',
    'password'             => 'A senha fornecida é incorreta.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato do campo :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório a menos que :other seja :value.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presentes.',
    'same'                 => 'Os campos :attribute e :other devem ser iguais.',
    'size'                 => [
        'numeric' => 'O valor de :attribute deve ser :size.',
        'file'    => 'O arquivo :attribute deve ter :size kilobytes.',
        'string'  => 'O campo :attribute deve ter :size caracteres.',
        'array'   => 'O campo :attribute deve ter :size itens.',
    ],
    'starts_with'          => 'O campo :attribute deve começar com um dos seguintes: :values.',
    'string'               => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve ser uma zona válida.',
    'unique'               => 'O campo :attribute já foi tomado.',
    'uploaded'             => 'O arquivo :attribute falhou ao ser carregado.',
    'url'                  => 'O campo :attribute deve ser uma URL válida.',
    'uuid'                 => 'O campo :attribute deve ser um UUID válido.',

    'attributes' => [
        'name'         => 'nome',
        'phone'        => 'telefone',
        'email'        => 'email',
        'languages'    => 'idiomas',
        'availability' => 'disponibilidade',
        'hourly_rate'  => 'valor da hora',
        'commission'   => 'repasse',
        'pix'          => 'chave Pix',
        'notes'        => 'observações',
        'password'     => 'senha',
    ],

    'custom' => [
        'name' => [
            'unique' => 'Esse nome já foi cadastrado.',
        ],
        'phone' => [
            'unique' => 'Esse telefone já foi cadastrado.',
        ],
        'email' => [
            'unique' => 'Esse email já foi cadastrado.',
        ],
        'pix' => [
            'unique' => 'Essa chave pix já foi cadastrada.',
        ],
        'password' => [
            'regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma minúscula, um número e um caractere especial.',
            'min' => 'A senha deve ter no mínimo 8 caracteres.',
            'confirmed' => 'A confirmação da senha não confere.',
        ],
    ],
];
