<?php
$bg = get_field('page_background');
if($bg) : ?>
<style>
.entry-content:after {
    content:'';
    position:absolute;
    bottom:0;
    height:200px;
    left:0;
    right:0;
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#000000+0,000000+100&0+42,0.65+100 */
   background: -moz-linear-gradient(top, rgba(0,0,0,0) 0% <?php echo $bg; ?> 100%); /* FF3.6-15 */
   background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%, <?php echo $bg; ?> 100%); /* Chrome10-25,Safari5.1-6 */
   background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, <?php echo $bg; ?> 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
   filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#a6000000',GradientType=0 ); /* IE6-9 */
}
</style>
<?php else : ?>

	<style>
	.entry-content:after {
	    content:'';
	    position:absolute;
	    bottom:0;
	    height:200px;
	    left:0;
	    right:0;
	    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#000000+0,000000+100&0+42,0.65+100 */
	   background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, white 100%); /* FF3.6-15 */
	   background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%, white 100%); /* Chrome10-25,Safari5.1-6 */
	   background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, white 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	   filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#a6000000',GradientType=0 ); /* IE6-9 */
	}
	</style>


<?php endif;
