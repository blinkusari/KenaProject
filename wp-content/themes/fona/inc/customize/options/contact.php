<?php
/**
 * Customize for Shop loop product
 */
return [
    [
        'type' => 'section',
        'name' => 'zoo_contact',
        'title' => esc_html__('Contact', 'fona'),
    ],
    [
        'name' => 'zoo_contact_general_settings',
        'type' => 'heading',
        'label' => esc_html__('Contact Settings', 'fona'),
        'section' => 'zoo_contact',
    ],
    [
        'name' => 'zoo_contact_type',
        'type' => 'select',
        'section' => 'zoo_contact',
        'title' => esc_html__('Contact Type', 'fona'),
        'default' => 'none',
        'choices' => [
            'none' => esc_html__('None', 'fona'),
            'phone' => esc_html__('Phone', 'fona'),
            'email' => esc_html__('Email', 'fona'),
            'messenger' => esc_html__('Messenger', 'fona'),
            'whatsapp' => esc_html__('Whatsapp', 'fona'),
            'skype' => esc_html__('Skype', 'fona'),
        ]
    ],
    [
        'type' => 'text',
        'name' => 'zoo_contact_id',
        'label' => esc_html__('Contact ID', 'fona'),
        'section' => 'zoo_contact',
        'description' => esc_html__('Your contact id. That is your phone, email or social id follow type contact you selected', 'fona'),
        'required' => ['zoo_contact_type', '!=', 'none'],
    ],
];
