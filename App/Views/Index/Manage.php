<div class="container grid-xl">
    <div class="columns mt-1">
        <div class="column">
            <div class="col-12">
                <span class="label label-default custom-label hide-sm">Current branch : <span class="text-error"><?=$modelData->branch?></span></span>
                <a href="/login" class="label label-default custom-label float-right">Login | register</a>
            </div>
            <div class="mb-2"></div>
        </div>
    </div>

    <div class="columns">

        <div class="column col-6 col-sm-8 col-mx-auto text-center">
            <h1>Timino PHP MVC 1.0.0</h1>
            <p>Default View no templating engine.</p>
            <img src="<?=$uploads->IMG . 'logo.png'?>" alt="logo" title="Timino" class="logo">
        </div>

        <div class="column col-12 mt-4 text-center links">
            <span><a href="#">Documentation</a></span>
            <span><a href="#">News </a></span>
            <span><a href="#">Contribute</a></span>
            <span><a href="#">Report</a></span>
            <span><a href="#">Donate</a></span>
        </div>


        <div class="column col-12 text-center">
            <div class="mt-4"></div>
            <div class="footer">
                <p><?=$lang->set('SLOGAN')?></p>
            </div>
        </div>
    </div>
</div>