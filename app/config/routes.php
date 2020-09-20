<?php

return [
  '' => [
    'controller'  => 'index',
    'action'      => 'main',
    'method'      => [
                      'header',
                      'content',
                      'footer',
                      'paginator',
                      ],
  ],
  'admin' => [
      'controller' => 'admin',
      'action' => 'manage',
      'method' => [
                    'header',
                    'content',
      ],
    ],
];

?>
