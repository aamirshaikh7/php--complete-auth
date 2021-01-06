<?php

$id = $_GET['id'];

require 'database/Connection.php';

require 'database/QueryBuilder.php';

$builder = new QueryBuilder(Connection::make());

$user = $builder->delete($id, 'users'); 