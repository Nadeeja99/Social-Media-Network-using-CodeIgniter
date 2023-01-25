<?php include 'components/timelineheader.php';?>

    <section class="text-center">
        <div class="p-5 bg-image" style="
            background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
            height: 300px;
            ">
        </div>

        <div class="card mx-4 mx-md-5 shadow-5-strong" style="
                margin-top: -250px;
                background: hsla(0, 0%, 100%, 0.8);
                backdrop-filter: blur(30px);
                ">
            <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                <h2 class="fw-bold mb-5">Create New Post</h2>
                <?php echo validation_errors(); ?>
                    <?php echo form_open_multipart('PostController/submitNewPost'); ?>

                        <div class="row">
                        <div class="col-md mb-4">
                            <h5 for="description">Description</h5>
                            <textarea placeholder="Add a description here" rows="6" class="form-control" name="description" ></textarea>
                        </div>
                        </div>


                        <div class="row">
                        <div class="col-md mb-4">
                            <h5 for="postimg">Upload a Image: </h5>
                            <input name="postimg" type="file">
                        </div>
                        </div>

                    
                        <button type="submit" class="btn btn-primary btn-block mb-4">
                        Post
                        </button>


                <?php echo form_close(); ?>
                </div>
            </div>
            </div>
        </div>
    </section>

    <?php include 'components/timelinefooter.php'; ?>