<?php

declare(strict_types=1);

return [
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'proxy_dir' => dirname(__DIR__, 2) . '/data/cache/DoctrineEntityProxy',
                'proxy_namespace' => 'DoctrineEntityProxy',
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'App\Model\EventReservation' => 'xml_mapping_driver',
                ],
            ],
            'xml_mapping_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\XmlDriver::class,
                'cache' => 'array',
                'paths' => dirname(__DIR__, 2) . '/src/Infrastructure/ORM/Mapping',
            ],
        ],
        'types' => [
            \App\Infrastructure\ORM\Type\EventIdType::NAME => \App\Infrastructure\ORM\Type\EventIdType::class,

            'uuid' => \Ramsey\Uuid\Doctrine\UuidType::class,
        ],
    ],
];
