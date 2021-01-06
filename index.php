<?php

require 'db_require.php';

$builder = new QueryBuilder(Connection::make());

$users = $builder->fetch('users');

require 'index.view.php';