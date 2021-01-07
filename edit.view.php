<?php include 'includes/header.php'; ?>

<?php
    $id = $_GET['id'];

    require 'db_require.php';
    
    $builder = new QueryBuilder(Connection::make());
    
    $user = $builder->put($id, 'users'); 

?>
    <div class="container" id="get-started">
        <div class="section">

        <div class="row">
            <form class="col s12" method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input value="<?= $user->name ?>" name="name" id="name" type="text" class="validate">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">mail</i>
                        <input value="<?= $user->email ?>" name="email" id="email" type="email" class="validate">
                        <label for="mail">E-mail</label>
                    </div>
                    <div class="col s12">
                        <button type="submit" class="btn-large center waves-effect waves-light blue">Update User</button>
                    </div>
                </div>
            </form>
        </div>
                
        </div>
    
    <br><br>
    </div>

<?php include 'includes/footer.php'; ?>