<?php

/**
 * @license   See LICENSE file
 * @copyright Copyright (C)1999,2005 easyDNS Technologies Inc. & Mark Jeftovic
 * @copyright Maintained by David Saez
 * @copyright Copyright (c) 2014 Dmitry Lukashin
 * @copyright Copyright (c) 2023 Kevin Lucich
 */

namespace phpWhois\Handlers;


class LtHandler extends AbstractHandler
{
    public function parse(array $data_str, string $query): array
    {
        $translate = [
            'contact nic-hdl:' => 'handle',
            'contact name:' => 'name'
        ];

        $items = [
            'admin' => 'Contact type:      Admin',
            'tech' => 'Contact type:      Tech',
            'zone' => 'Contact type:      Zone',
            'owner.name' => 'Registrar:',
            'owner.email' => 'Registrar email:',
            'domain.status' => 'Status:',
            'domain.created' => 'Registered:',
            'domain.changed' => 'Last updated:',
            'domain.nserver.' => 'NS:',
            '' => '%'
        ];

        return [
            'regrinfo' => static::easyParser($data_str['rawdata'], $items, 'ymd', $translate),
            'regyinfo' => $this->parseRegistryInfo($data_str['rawdata']) ?? [
                'registrar' => 'DOMREG.LT',
                'referrer' => 'https://www.domreg.lt'
            ],
        ];
    }
}
