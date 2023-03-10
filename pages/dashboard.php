<?php

// make sure the user has a valid role
if ( !Authentication::whoCanAccess('user') ) {
  header('Location: /login');
  exit;
}
require dirname(__DIR__) . '/parts/header.php';
?>
<div class="five">
  
  <div class="container " style="max-width: 800px;">
    <h1 class="h1 mb-4 text-center py-5 text-white">Dashboard</h1>
    <div class="row">
      <div class="col">
        <div class="card mb-2">
          <div class="card-body">
            <h5 class="card-title text-center">
              <div class="mb-1">
                <i class="bi bi-card-text" style="font-size: 3rem;"></i>
              </div>
              Manage information
            </h5>
            <div class="text-center mt-3">
              <a href="/manage-informations" class="btn btn-primary btn-sm">
                Access
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <!-- manage users start -->
      <?php if ( Authentication::whoCanAccess('admin') ) : ?>
        <div class="col">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title text-center">
                <div class="mb-1">
                  <i class="bi bi-people" style="font-size: 3rem;"></i>
                </div>
                Manage Users
              </h5>
              <div class="text-center mt-3">
                <a href="/manage-users" class="btn btn-primary btn-sm">
                  Access
                </a>
              </div><!-- .text-center -->
            </div><!-- .card-body -->
          </div><!-- .card -->
        </div><!-- .col -->
        <?php endif; ?>
        <!-- manage users end -->
        
      </div><!-- .row -->
      <div class="mt-4 text-center">
        <a href="/" class="btn btn-link btn-sm"
        ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
      
      </div><!-- .container -->
      </div>
      <?php

require dirname(__DIR__) . '/parts/footer.php';
