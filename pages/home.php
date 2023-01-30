<?php

    require dirname(__DIR__) . '/parts/header.php';
?>
<div class="two">
  <div class="container " style="max-width: 500px;">
    <h1 class="h1 mb-4 text-center py-5 text-white">Student information</h1>
    <?php foreach( Information::getPublishInformations() as $information ) : ?>
      <div class="card mb-2">
        <div class="card-body">
          <h1 class="card-title"><?php echo $information['student_name']; ?></h1>
          <div class="text-end">
            <a href="/information?id=<?php echo $information['id']; ?>">Read More</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      
      <div class="mt-4 d-flex justify-content-center gap-3">
        <?php if ( Authentication::isLoggedIn() ) : ?>
          <a href="/dashboard" class="btn btn-link btn-sm">Dashboard</a>
          <a href="/logout" class="btn btn-link btn-sm">Logout</a>
          <?php else : ?>
            <a href="/login" class="btn btn-link btn-sm">Login</a>
            <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>
            <?php endif; ?>
      </div>
    </div>
  </div>
    <?php

require dirname(__DIR__) . '/parts/footer.php';