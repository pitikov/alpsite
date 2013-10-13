<?php

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'site_user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Site user',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'federation_member' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Member of alp.federation',
        'children' => array(
            'site_user', // унаследуемся от пользователя сайта
        ),
        'bizRule' => null,
        'data' => null
    ),
    'club_member' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Member of alp.club',
        'children' => array(
            'site_user', // унаследуемся от пользователя сайта
        ),
        'bizRule' => null,
        'data' => null
    ),
        'root' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'superuser',
        'children' => array(
            'site_user', // унаследуемся от пользователя сайта
            'federation_member',
            'club_member',
        ),
        'bizRule' => null,
        'data' => null
    ),
);

?>