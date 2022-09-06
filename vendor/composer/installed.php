<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => '__root__',
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
        'chillerlan/php-qrcode' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'type' => 'library',
            'install_path' => __DIR__ . '/../chillerlan/php-qrcode',
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'reference' => 'c43715795d0fbcc913a2e9c5f8c757062ce0e8c7',
            'dev_requirement' => false,
        ),
        'chillerlan/php-settings-container' => array(
            'pretty_version' => '2.1.4',
            'version' => '2.1.4.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../chillerlan/php-settings-container',
            'aliases' => array(),
            'reference' => '1beb7df3c14346d4344b0b2e12f6f9a74feabd4a',
            'dev_requirement' => false,
        ),
    ),
);
