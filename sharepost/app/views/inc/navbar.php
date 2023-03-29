<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3" aria-label="First navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo URL;?>"><?php echo SITE;?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample01">
        <ul class="navbar-nav me-auto mb-2">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo URL;?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL;?>/pages/about">About</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto mb-2">
          <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
            <a class="nav-link" href="#">Welcome <?php echo $_SESSION['user_name']?></a>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo URL;?>/users/logout">logout</a>
          </li>
          <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo URL;?>/users/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL;?>/users/login">login</a>
          </li>
          <?php endif; ?>

        </ul>
      </div>
  </nav>