<?php

//show error
function show_errors($errors = null) {
    if (count($errors) > 0) {
        ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors->all() as $error) { ?>
                    <li><?php echo $error; ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <?php if (Session::has('Mess')) { ?>
        <div class="alert alert-success">
            <p><?php echo Session::get('Mess') ?></p>
        </div>
    <?php } ?>
    <?php if (Session::has('errorMess')) { ?>
        <div class="alert alert-danger">
            <p><?php echo Session::get('errorMess'); ?></p>
        </div>
        <?php
    }
}



