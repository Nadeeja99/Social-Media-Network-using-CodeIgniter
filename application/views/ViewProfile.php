<?php include 'components/timelineheader.php';?>
    <div class="container col text-center">
        <?php 
        if ($data['isFollowed'] == 'false') { ?> 
            <a href="<?php echo site_url('/UserController/followUser/'.$data['viewUserId']); ?>">
                <button style="width: 50%; margin-top:30px" type="button" class="btn btn-primary">
                    Follow
                </button>
            </a>
        <?php } else { ?>
            <a href="<?php echo site_url('/UserController/unfollowUser/'.$data['viewUserId']); ?>">
                <button style="width: 50%; margin-top:30px" type="button" class="btn btn-danger">
                    Unfollow
                </button>
            </a>
        <?php } ?> 
    </div>


    <?php if ($data['userPosts'] !== null) { ?>
        <div class="container">
            <ul>
                <?php foreach ($data['userPosts'] as $post) { ?>
                    <div class="container">
                        <section class="mx-auto my-5" style="max-width: 50rem;">

                            <div class="card">
                            <div class="card-body d-flex flex-row">
                                <img src=<?php echo base_url('./uploads/userAvatar.png'); ?> class="rounded-circle me-3" height="50px"
                                width="50px" alt="avatar" />
                                <div>
                                    <a href="<?php echo site_url('/PostController/viewUserProfile/'.$post->userId); ?>" style="text-decoration:none">
                                        <h5 style="margin-left:10px" class="card-title font-weight-bold mb-2"><?php echo $post->userName; ?></h5>
                                    </a>
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
                            </div>
                            
                        </section>
                    </div>
                <?php } ?>
            </ul>
        </div>
        <hr>
    <?php } ?>
</div>
<?php include 'components/timelinefooter.php'; ?>