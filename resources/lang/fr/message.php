<?php

return [
    'erreur' => [
        'expedition' => [
            'affectation' => 'Oups! Un professionnel vous a dévancé sur ce coup! Cette offre a été déjà acceptée. Soyez plus rapide la prochaine fois.'
        ],
        'vehicule' => [
            'limite' => 'Votre statut de professionnel ne vous permet pas d\'ajouter un véhicule.'
        ],
        'offre' => [
            'nontrouve' => 'L\'offre que vous essayez de traiter est introuvable.'
        ],
    ],

    'inscription' => [
        'transporteur' => [
            \App\Work\Tools::MESSAGE_SUCCESS => 'Votre inscription a été prise en compte.',
            \App\Work\Tools::MESSAGE_INFO => 'Un email vous a été envoyé à l\'adresse  que vous avez fourni. Une confirmation d\'inscription vous sera envoyée après analyse de votre dossier.',
            \App\Work\Tools::MESSAGE_WARNING => 'L\'adresse email que vous avez fourni n\'est pas une adresse email valide',
        ],
        'client' => [
            'exprire' => 'Votre jeton de sécurité a expiré. Nous vous avons renvoyé un autre afin de vérifier notre email.',
        ]
    ],

    'expedition' => [
        'create' => "Votre expédition a été programmé pour le :date. Vous serez contacté dans de bref délais.",
        'accept' => 'L\'offre d\'expédition :reference a été prise en charge par vous. Veuillez rentrer en contact avec le client dans de bref délais.',
    ],

    'vehicule' => [
        'nouveau' => 'Un nouveau véhicule immatriculation :immat a été ajouté à votre flotte.'
    ]

];