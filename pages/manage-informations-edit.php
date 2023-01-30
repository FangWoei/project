<?php

    // redirect to login page if not logged in
    if ( !Authentication::whoCanAccess('user') ) {
        header( 'Location: /login' );
        exit;
    }

    $information = Information::getinformationByID( $_GET['id'] );

    // step 1: set CSRF token
  CSRF::generateToken( 'edit_information_form' );

  // step 2: make sure information request
  if ( $_SERVER["REQUEST_METHOD"] === 'POST' ) {

    // step 3: do error check

      // skip error checking for both fields.
      $rules = [
      'student_name' => 'required',
      'email' => 'required',
      'phone_number' => 'required',
      'gender' => 'required',
      'student_ID' => 'required',
      'entry_year' => 'required',
      'content' => 'required',
      'csrf_token' => 'add_information_form_csrf_token',
      ];

      // if eiter password & confirm_password fields are not empty, 
      // do error check for both fields
      $error = FormValidation::validate(
        $_POST,
        $rules
      );

      // make sure there is no error
      if ( !$error ) {
        // step 4: update information
        Information::update(
          $information['id'], // id
          $_POST['student_name'],
          $_POST['email'],
          $_POST['phone_number'],
          $_POST['gender'],
          $_POST['student_ID'],
          $_POST['entry_year'],
          $_POST['content'],
          $_POST['status'],
        );

        // step 5: remove the CSRF token
        CSRF::removeToken( 'edit_information_form' );

        // Step 6: redirect to manage users page
        header("Location: /manage-informations");
        exit;

      }
  }

    require dirname(__DIR__) . '/parts/header.php';
?>
<div class="ten">
    <div class="container " style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="h1 py-5">Edit Info</h1>
        </div>
        <div class="card mb-2 p-4">
            <?php require dirname( __DIR__ ) . '/parts/error_box.php'; ?>
            <form
            method="POST"
            action="<?php echo $_SERVER["REQUEST_URI"]; ?>"
            >
            <div class="d-flex">
                <div class="mb-3 col-5">
                    <label for="information-student_name" class="form-label">Student Name</label>
                    <input type="text" class="form-control" id="information-name" name="student_name" value="<?php echo $information['student_name']; ?>">
                </div>
                <div class="col-1"></div>
                <div class="mb-3 col-5">
                    <label for="information-email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="information-email" name="email" value="<?php echo $information['email']; ?>">
                </div>
            </div>
            <div class="d-flex">
                <div class="mb-3 col-5">
                    <label for="information-phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="information-phone_number" name="phone_number" value="<?php echo $information['phone_number']; ?>">
                </div>
                <div class="col-1"></div>
                <div class="mb-3 col-5">
                    <label for="information-content" class="form-label">Gender</label>
                    <select class="form-control" id="information-gender" name="gender">
                    <option value="" >Select your Gender</option>
                    <option value="male" <?php echo ( $information['gender'] == 'male' ? 'selected' : '' ); ?>>Male</option>
                    <option value="female" <?php echo ( $information['gender'] == 'female' ? 'selected' : '' ); ?>>Female</option>
                    </select>
                </div>
            </div>
            <div class="d-flex">
                <div class="mb-3 col-5">
                    <label for="information-student_ID" class="form-label">Student_ID</label>
                    <input type="text" class="form-control" id="information-student_ID" name="student_ID" value="<?php echo $information['student_ID']; ?>">
                </div>
                <div class="col-1"></div>
                <div class="mb-3 col-5">
                    <label for="information-entry_year" class="form-label">Entry_Year</label>
                    <input type="text" class="form-control" id="information-entry_year" name="entry_year" value="<?php echo $information['entry_year']; ?>">
                </div>
            </div>
            <div class="mb-3 col-12">
                <label for="information-content" class="form-label">Content</label>
                <textarea class="form-control" id="information-content" rows="10" name="content"><?php echo $information['content']; ?></textarea>
            </div>
            <div class="col-12">
                <label for="information-content" class="form-label">Status</label>
                <select class="form-control" id="information-status" name="status">
                    <option value="pending" <?php echo ( $information['status'] == 'pending' ? 'selected' : '' ); ?>>Pending for Review</option>
                    <option value="publish" <?php echo ( $information['status'] == 'publish' ? 'selected' : '' ); ?>>Publish</option>
                </select>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <input
                type="hidden"
                name="csrf_token"
                value="<?php echo CSRF::getToken( 'edit_information_form' ); ?>"
                />
            </form>
        </div>
        <div class="text-center">
            <a href="/manage-informations" class="btn btn-link btn-sm"><i class="bi bi-arrow-left"></i>Back</a>
        </div>
    </div>
    </div>
    <?php
    
    require dirname(__DIR__) . '/parts/footer.php';