<?php
require(get_stylesheet_directory_uri() . '/rewardsystem/core/core-rewards.php');
$cores = new CoreRewards();

if($cores->accessable_reward){
?>

<div class="section-content relative">
    <div class="row" id="row-2023455583">
        <div class="col medium-3 small-6 large-3">
            <div class="col-inner">
                <div style="border:1px solid #d8d8d8;border-radius:5px;padding:8px;">Your Point<p></p>
                    <h1><?php echo $cores->point_format($cores->get_user_point()); ?> Point</h1>
                </div>
            </div>
        </div>
        <div class="col medium-3 small-6 large-3">
            <div class="col-inner">
                <div style="border:1px solid #d8d8d8;border-radius:5px;padding:8px;">SP Nasional<p></p>
                    <h1><?php echo $cores->point_format($cores->get_shopping_point_nasional()); ?></h1>
                </div>
            </div>
        </div>
        <div class="col medium-3 small-6 large-3">
            <div class="col-inner">
            </div>
        </div>
        <div class="col medium-3 small-6 large-3">
            <div class="col-inner">
            </div>
        </div>
    </div>
</div>
<?php } ?>