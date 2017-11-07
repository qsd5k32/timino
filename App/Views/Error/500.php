<div class="container grid-xl">
    <div class="columns">
        <div class="column">
            <div class="col-12">
                <span class="label label-default label-rounded custom-label">Current branch : <span class="text-error">develop</span></span>
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
                    <?=$modelData->getMessage()?>
                </p>
            </div>
            <div class="code">
                <pre>
                <code><?php print_r($modelData->getTrace())?></code>
            </div>
        </div>
    </div>
</div>