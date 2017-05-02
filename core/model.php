<?php

namespace Kirby\Panel\Models;

use Dir;

class BP {

  public function __construct() {
    //$this->index = panel()->site()->index();
    $this->blueprints = dir::read(kirby()->roots()->blueprints());
    $this->templates = dir::read(kirby()->roots()->templates());
    $this->snippets = dir::read(kirby()->roots()->snippets());
  }

  public function topbar($topbar) {
    $topbar->append(purl('editor'), 'Editor');
  }

}
