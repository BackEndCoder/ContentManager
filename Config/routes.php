<?php
Router::connect('/:contentSlug', array('plugin' => 'content_manager', 'controller' => 'contents', 'action' => 'view'));