<?php include 'includes/header.php'; ?>

<?php
    require 'db_require.php';
    
    $builder = new QueryBuilder(Connection::make());
    
    $builder->signin('auth');

?>
    <div class="container" id="get-started">
        <div class="section">

        <div class="row">

            <?php if(isset($_GET['message'])) : ?>
                <div class="col s12">
                    <div class="card red darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">
                                <?= $_GET['message']; ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form class="col s12" method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="email" id="email" type="text" class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_open</i>
                        <input name="password" id="password" type="password" class="validate">
                        <label for="password">Password</label>
                    </div>
                    <div class="col s12">
                        <button name="submit" type="submit" class="btn-large center waves-effect waves-light blue">Login</button>
                    </div>
                </div>
            </form>
        </div>
                
        </div>
    
    <br><br>
    </div>

<?php include 'includes/footer.php'; ?>