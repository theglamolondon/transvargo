<?php

return [
    'inscription' => [
        'transporteur' => [
            \App\Work\Tools::MESSAGE_SUCCESS => 'Votre inscription a été prise en compte.',
            \App\Work\Tools::MESSAGE_INFO => 'Un email vous a été envoyé à l\'adresse  que vous avez fourni. Une confirmation d\'inscription vous sera envoyée après analyse de votre dossier.',
            \App\Work\Tools::MESSAGE_WARNING => 'L\'adresse email que vous avez fourni n\'est pas une adresse email valide',
        ],
        'client' => [

        ]
    ],
    'expedition' => [
        'create' => "Votre expédition a été programmé pour le :date. Vous serez contacté dans de bref délais."
    ]

];