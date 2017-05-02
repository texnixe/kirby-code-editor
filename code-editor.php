<?php

kirby()->set('widget', 'editor', __DIR__ . '/widgets');
if(function_exists('panel') && $panel = panel()) {
  $panel->routes = array_merge([
    [
      'pattern' => 'editor',
      'action'  => function() {
        require 'core/controller.php';
        require 'core/model.php';

        $editor = new BPController;
        echo $editor->index();
      },
      'method'  => 'GET|POST'
    ],
    [
      'pattern' => 'editor/(:any)/(:any)',
      'action'  => function($folder, $file) {
        $result = f::read(kirby()->roots()->{$folder}() . '/' . $file);
        f::write(kirby()->roots()->index() . '/test.txt', $result);
        return $result;
      },
      'method'  => 'GET|POST'
    ],
    [
      'pattern' => 'editor/save/(:any)/(:any)',
      'action'  => function($folder, $file) {
        $data = kirby()->request()->data();
        $data = $data['cont'];
        $data = json_decode($data);
        f::write(kirby()->roots()->{$folder}() . '/' . $file, $data);
      },
      'method'  => 'POST'
    ],
  ], $panel->routes);
}
