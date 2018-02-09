<?php

require 'vendor/autoload.php';

class RelativeDate {

  protected $carbon;

  public function __construct($date) {
    $this->carbon = new Carbon\Carbon($date);
    Carbon\Carbon::setLocale(site()->locale());
  }

  public function __call($name, $args) {
    return $this->carbon->{$name}($args);
  }

  public function __toString() {
    return $this->carbon->diffForHumans();
  }
}


$kirby->set('tag', 'relativeDate', [
  'html' => function($tag) {
    return relativeDate($tag->attr('relativedate'));
  }
]);

$kirby->set('field::method', 'relativeDate', function($field) {
  return relativeDate($field->value);
});

function relativeDate($date) {
  return new RelativeDate($date);
}
