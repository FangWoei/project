<?php

    // redirect to login page if not logged in
    if ( !Authentication::whoCanAccess('user') ) {
        header( 'Location: /login' );
        exit;
    }

        // Step 1: generate CSRF token
        CSRF::generateToken( 'delete_information_form' );

        // Step 2: make sure it's POST request
        if ( $_SERVER["REQUEST_METHOD"] === 'POST' ) {
    
        // step 3: do error check
        $error = FormValidation::validate(
            $_POST,
            [
            'information_id' => 'required',
            'csrf_token' => 'delete_information_form_csrf_token'
            ]
        );
    
        // make sure there is no error
        if ( !$error ) {
            // step 4: delete information
            Information::delete( $_POST['information_id'] );
    
            // step 5: remove CSRF token
            CSRF::removeToken( 'delete_information_form' );
    
            // step 6: redirect back to the same page
            header("Location: /manage-informations");
            exit;
    
        } // end - $error
    
        } // end - $_SERVER["REQUEST_METHOD"]
    



    require dirname(__DIR__) . '/parts/header.php';
?>
<div class="nine">
    <div class="container " style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="h1 py-5">Manage Students Info</h1>
            <div class="text-end">
                <a href="/manage-informations-add" class="btn btn-primary btn-sm">Add New</a>
            </div>
        </div>
        <div class="card mb-2 p-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" style="width: 40%;">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( Information::getAllinformations( $_SESSION['user']['id'] ) as $information ) : ?>
                        <tr>
                            <th scope="row"><?php echo $information['id']; ?></th>
                    <td><?php echo $information['student_name']; ?></td>
                    <td>
                        <?php 
                        switch( $information['status'] ) {
                            case 'pending':
                                echo '<span class="badge bg-warning">Pending Review</span>';
                                break;
                                case 'publish':
                                    echo '<span class="badge bg-success">Publish</span>';
                                    break;
                                }
                                ?>
                    </td>
                    <td class="text-end">
                        <div class="buttons">
                            <a href="/information?id=<?php echo $information['id']; ?>" target="_blank" class="btn btn-primary btn-sm me-2 <?php echo ( $information['status'] === 'pending' ? 'disabled' : '' ); ?>"><i class="bi bi-eye"></i></a>
                            <a href="/manage-informations-edit?id=<?php echo $information['id']; ?>" class="btn btn-secondary btn-sm me-2"><i class="bi bi-pencil"></i></a>
                            
                            <!-- Delete button Start -->
                            <!-- Button trigger modal -->
                            <button 
                            type="button" 
                            class="btn btn-danger btn-sm" 
                            data-bs-toggle="modal" 
                                data-bs-target="#information-<?php echo $information['id']; ?>">
                                <i class="bi bi-trash"></i>
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="information-<?php echo $information['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                Are you sure you want to delete this info (<?php echo $information['student_name']; ?>)
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form
                                                method="POST"
                                                action="<?php echo $_SERVER["REQUEST_URI"]; ?>"
                                                >
                                                <input 
                                                type="hidden" 
                                                name="information_id" 
                                                value="<?php echo $information['id']; ?>" 
                                                />
                                                <input 
                                                type="hidden" 
                                                name="csrf_token" 
                                                value="<?php echo CSRF::getToken( 'delete_information_form' ); ?>"
                                                />
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete button end -->
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
    </div>
</div>
</div>
<?php
    
    require dirname(__DIR__) . '/parts/footer.php';