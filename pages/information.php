<?php


$information = Information::getInformationByID( $_GET['id'] );

require dirname(__DIR__) . '/parts/header.php';
?>
<div class="twelve">
    <div class="container " style="max-width: 500px;">
        <h1 class="mb-4 text-center py-5"><?php echo $information['student_name']; ?></h1>
        <div class="card mb-2 p-4">
            <form
            class="row"
        method="POST"
        action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
        <div class="d-flex">
            <div class="mb-3 col-12">
                <h5>Email :</h5>
                <p><?php echo( $information['email'] ) ?></p>
            </div>
        </div>
        <div class="d-flex">
            <div class="mb-3 col-5">
                <h5>Phone Number :</h5>
                <p><?php echo( $information['phone_number'] ) ?></p>
            </div>
            <div class="col-1"></div>
            <div class="mb-3 col-5">
                <h5>Gender :</h5>
                <p><?php echo( $information['gender'] ) ?></p>
            </div>
        </div>
        <div class="d-flex">
            <div class="mb-3 col-5">
                <h5>Student_ID :</h5>
                <p><?php echo( $information['student_ID'] ) ?></p>
            </div>
            <div class="col-1"></div>
            <div class="mb-3 col-5">
                <h5>Entry_Year :</h5>
                <p><?php echo( $information['entry_year'] ) ?></p>
            </div>
        </div>
        <div class="d-flex">
            <div class="mb-3 col-12">
                <h5>Content :</h5>
                <p><?php echo( $information['content'] ) ?></p>
            </div>
        </div>
    </form>
</div>
<div class="text-center mt-3">
    <a href="/" class="btn btn-link btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
</div>
</div>
</div>
<?php

require dirname(__DIR__) . '/parts/footer.php';