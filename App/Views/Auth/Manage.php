
<div class="container">
    <div class="columns">
        <div class="column mt-5"></div>
    </div>
</div>



<div class="container grid-md">


    <!-- vertical divider element with text -->
    <div class="columns">
        <div class="column col-sm-10 col-md-8 col-mx-auto">

            <h1 class="text-center">Login</h1>

            <form action="/auth/login" method="POST">

                <?php if(is_array(@$modelData->login)):?>

                    <?php foreach( $modelData->login as $err): ?>
                        <div class="toast toast-error mb-1"><?=$err?></div>
                    <?php endforeach;?>

                <?php endif;?>

                <!-- form input control -->
                <div class="form-group">
                    <label class="form-label" for="email">Email :</label>
                    <input class="form-input" name="u_email" type="email" id="email" placeholder="Email Adress">
                </div>

                <!-- form input control -->
                <div class="form-group">
                    <label class="form-label" for="pass">Password :</label>
                    <input class="form-input" name="u_pass" type="password" id="pass" placeholder="Password">
                </div>

                <!-- form checkbox control -->
                <div class="form-group mt-2">
                    <label class="form-checkbox">
                        <input type="checkbox" name="u_rem" value="remmberme">
                        <i class="form-icon"></i> Remember me
                    </label>
                </div>
                <input type="hidden" name="CSRF" value="<?=$modelData->CSRF?>">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </form>

            <!-- column content -->
        </div>


        <div class="divider-vert hide-md" data-content="OR"></div>  <!-- register -->

        <div class="column col-sm-10 col-md-8 col-mx-auto">
            <h1 class="text-center">Register</h1>

            <form action="/auth/register" method="POST">

                <?php if(is_array(@$modelData->register)):?>

                    <?php foreach( $modelData->register as $err): ?>
                        <div class="toast toast-error mb-1"><?=$err?></div>
                    <?php endforeach;?>

                <?php endif;?>

                <?php if(@$modelData->register === true):?>

                    <div class="toast toast-success mb-1"> User Has Been added successfully !</div>
                <?php endif?>

                <!-- form input control -->
                <div class="form-group">
                    <label class="form-label" for="email">Email :</label>
                    <input class="form-input" name="u_email" type="email" id="email" placeholder="Email Adress">
                </div>

                <!-- form input control -->
                <div class="form-group">
                    <label class="form-label" for="pass">Password :</label>
                    <input class="form-input" name="u_pass" type="password" id="pass" placeholder="Password">
                </div>
                <!-- form input control -->
                <div class="form-group">
                    <label class="form-label" for="uc_pass">Confirm Password :</label>
                    <input class="form-input" name="uc_pass" type="password" id="uc_pass" placeholder="Confirm Password">
                </div>

                <!-- form radio control -->
                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <label class="form-radio">
                        <input type="radio" name="gender" value="M" checked>
                        <i class="form-icon"></i> Male
                    </label>
                    <label class="form-radio">
                        <input type="radio" name="gender" value="F">
                        <i class="form-icon"></i> Female
                    </label>
                </div>


                <input type="hidden" name="CSRF" value="<?=$modelData->CSRF?>">
                <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>

                <div class="btn btn-block btn-link">Learn more !</div>
            </form>


            <!-- column content -->
        </div>
    </div>


</div>