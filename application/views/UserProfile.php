<?php include 'components/timelineheader.php';?>

    <div class="container col text-center">
        <a href="<?php echo site_url('/PostController/createPost'); ?>">
            <button style="width: 50%; margin-top:30px"  type="button" class="btn btn-primary">
                Create Post
            </button>
        </a>
    </div>

    <?php if ($userPosts !== null) { ?>
        <div class="container">
            <ul>
                <?php foreach ($userPosts as $post) { ?>
                    <div class="container">
                        <section class="mx-auto my-5" style="max-width: 50rem;">

                            <div class="card">
                            <div class="card-body d-flex flex-row">
                                <img src=<?php echo base_url('./uploads/userAvatar.png'); ?> class="rounded-circle me-3" height="50px"
                                width="50px" alt="avatar" />
                                <div>
                                <div class="raw">
                                    <a href="<?php echo site_url('/PostController/viewUserProfile/'.$post->userId); ?>" style="text-decoration:none">
                                        <h5 style="margin-left:10px" class="card-title font-weight-bold mb-2"><?php echo $post->userName; ?></h5>
                                    </a>
                                    <div class="btn-group">
                                            <a href="<?php echo site_url('/PostController/editPost/'.$post->postId); ?>" class="btn btn-primary">Edit</a>
                                            <a href="<?php echo site_url('/PostController/delete_post/'.$post->postId); ?>" class="btn btn-danger">Delete</a>
                                        </div></div>
                                <p style="margin-left:10px" class="card-text"><i class="far fa-clock pe-2"></i><?php echo $post->createddate; ?></p>
                                </div>
                            </div>
                            <div class="bg-image hover-overlay ripple rounded-0">
                                <img class="img-fluid" src="<?php echo base_url('uploads/').$post->post_image; ?>"
                                alt="Card image cap" />
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <?php echo $post->description; ?>
                                </p>
                            </div>
                        </section>
                    </div>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</div>

<?php include 'components/timelinefooter.php'; ?>