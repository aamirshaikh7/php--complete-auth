<?php include 'includes/header.php'; ?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h2 class="header center blue-text">Manage Users Efficiently !</h2>
      <div class="row center">
        <h5 class="header col s12 light">A modern responsive CRUD Application for Employee Management</h5>
      </div>
      <div class="row center">
        <a href="#get-started" class="btn-large waves-effect waves-light blue">Lets Get Started</a>
      </div>
      <br><br>

    </div>
  </div>

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center black-text"><i class="material-icons">directions_run</i></h2>
            <h5 class="center">Speeds up development</h5>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center black-text"><i class="material-icons">group</i></h2>
            <h5 class="center">User Experience Focused</h5>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center black-text"><i class="material-icons">sentiment_very_satisfied</i></h2>
            <h5 class="center">Easy to work with</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container" id="get-started">
    <div class="section">

      <ul class="">

        <?php foreach($users as $user) : ?>
          <div class="collection-item avatar">
            <div class="row">
              <div class="col s6">
                <i class="material-icons circle">person</i>
                <span class="name">
                  <?= $user->name ?>
                </span>
                <p><?= $user->email ?></p>
              </div>
              <div class="col s6" style="padding-top: 30px;">
                <ul style="display: flex;justify-content: end;">
                  <li><a href="./edit.view.php?id=<?= $user->id ?>" class=""><i class="material-icons">edit</i></a></li>
                  <li style="padding-left: 5px;"><a href="./delete.php?id=<?= $user->id ?>" class=""><i class="red-text material-icons">delete</i></a></li>
                </ul>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        
      </ul>
    </div>    
  </div>
    
    <br><br>
  </div>

<?php include 'includes/footer.php'; ?>
