<?php include 'includes/header.php'; ?>

<?php
    require 'db_require.php';
    
    $builder = new QueryBuilder(Connection::make());
    
    $builder->signup('auth');
?>
    <div class="container" id="get-started">
        <div class="section">

        <div class="row">
            <form class="col s12" method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="name" id="name" type="text" class="validate">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input name="email" id="email" type="text" class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_open</i>
                        <input name="password" id="password" type="password" class="validate">
                        <label for="password">Password</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">repeat</i>
                        <input name="repeat" id="repeat" type="password" class="validate">
                        <label for="repeat">Repeat Password</label>
                    </div>
                    <div class="col s12">
                        <button type="submit" name="submit" class="btn-large center waves-effect waves-light blue">Signup</button>
                    </div>
                </div>
            </form>
        </div>
                
        </div>
    
    <br><br>
    </div>

<?php include 'includes/footer.php'; ?>