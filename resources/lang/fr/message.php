<?php

return [
    'erreur' => [
        'expedition' => [
            'affectation' => 'Oups! Un professionnel vous a dévancé sur ce coup! Cette offre a été déjà acceptée. Soyez plus rapide la prochaine fois.',
            'notfound' => 'Cette expédition est introuvable. La référence est peut-être erronée.'
        ],
        'vehicule' => [
            'limite' => 'Votre statut de professionnel ne vous permet pas d\'ajouter un véhicule.'
        ],
        'offre' => [
            'nontrouve' => 'L\'offre que vous essayez de traiter est introuvable.'
        ],
        'identite' => [
            'noactivate' => 'Votre compte n\'a encore pas été confirmé. Veuillez cliquer sur le lien qui vous a été envoyé par email.'
        ],
        'transporteur' => [
            'notfound' => 'Transporteur non trouvé.'
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

    'profil' => [
        "update" => "Votre profil a été modiffié avec succès !"
    ],

    'expedition' => [
        'initiee' => 'Votre demande d\'expédition a été initée, veuillez complèter quelques informations SVP.',
        'create' => "Un commercial entrera en contact avec vous par téléphone pour vous faire un devis afin de mieux prendre en charge votre expédition.",
        'accept' => 'L\'offre d\'expédition :reference a été affeectée à un transporteur.',
    ],

    'vehicule' => [
        'nouveau' => 'Un nouveau véhicule immatriculation :immat a été ajouté à votre flotte.'
    ],

    'site' => [
        'contact' => 'Votre message a été bien envoyé à notre équipe. Transvargo vous remercie !'
    ],

    'staff' => [
        'valid-transporteur' => "Le transporteur :transporteur est désomais actif et capable de recevoir des offres.",
        "transporteur" => [
            "update" => "Les infos du transporteur ont été mises à jour avec succès."
        ],
    ],

];