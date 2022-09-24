<?php
return [
    'base_route'      => 'admin/filemanager',
    'middleware'      => ['web', 'admin'],
    'allow_format'    => 'jpeg,jpg,png,gif,webp',
    'max_size'        => 100000,
    'max_image_width' => 3024,
    'image_quality'   => 100,
];