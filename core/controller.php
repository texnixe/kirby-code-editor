<?php

use Kirby\Panel\View;
use Kirby\Panel\Topbar;

use Kirby\Panel\Models\BP;

class BPController extends Kirby\Panel\Controllers\Base {

  public function index() {

    $editor   = new BP;
    $content = new View('core/view', ['blueprints' => $editor->blueprints, 'templates' => $editor->templates, 'snippets' => $editor->snippets]);
    $content->_root = dirname(__DIR__);

    return $this->layout('app', [
      'topbar'  => new Topbar('editor', $editor),
      'content' => $content
    ]);
  }

}
