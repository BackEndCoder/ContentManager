<?php

App::uses('ContentRoute', 'ContentManager.Route');

Router::connect('/:contentSlug', array('plugin' => 'content_manager', 'controller' => 'contents', 'action' => 'view'), array('routeClass' => 'ContentRoute'));