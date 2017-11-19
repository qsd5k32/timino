<div class="container grid-xl">
    <div class="columns">
        <div class="column">
            <div class="col-12">
                <span class="label float-left hide-sm"><b>Current branch</b> : <span><?=$modelData->branch?></span></span>
                <span class="label float-right"><b>Version </b>: 1.0.0</span></span>
                <!--#link#-->
                <div class="clear-fix"></div>
            </div>
            <div class="mg-btm-1rem"></div>
        </div>
    </div>
</div>

<div class="container grid-lg">
    <div class="columns">
        <div class="column col-xs-10 col-xl-8 col-mx-auto">
            <h1 class="text-center">Woops ! Something broken.</h1>
            <h2 class="text-center">Server Error 500</h2>
        </div>
    </div>
    <div class="columns">
        <div class="column col-xs-10 col-xl-8 col-mx-auto">
            <div class="bg-dark">
                <p class="text-justify error-p">
                    <?=$modelData->Exception->getMessage()?>
                </p>
            </div>
            <div class="code">
                <pre>
                <code><?php print_r($modelData->Exception->getTrace())?></code>
            </div>
        </div>
    </div>
</div>