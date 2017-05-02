<?php

$title = 'Code Editor';

return [
  'title' => [
    'text'       => $title,
    'compressed' => true
  ],
  'options' => [
    [
      'text' => 'Open View',
      'icon' => 'code',
      'link' => purl('editor')
    ]
  ],
  'html' => function() {
    return false;
  }
];
