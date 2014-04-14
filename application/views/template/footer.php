		<!--FOTTER MULAI-->
		<div class="footer">
		<p>Copyright Bappeda Kota Solok 2013</p><div class="link">
			<?php
                    if($link_all == "NULL"){
                        ?><a href="<?php echo base_url(); ?>">BERANDA</a><?php
                    } else {
                        foreach ($link_all as $link) {
                            ?><a href="<?php echo $link->url; ?>"><?php echo $link->title; ?></a>
                <?php
                            
                        }
                    }
                    ?>
            <div class="clear"></div>
	</div>
	</div>
</div>
    <script type="text/javascript">
    $(window).load(function() {
    	/*var left = $('.content-left').height();
    	var midle = $('.kolom-midle').height();
    	var right = $('.kolom-right').height();

    	if(+left > +midle){
    		var max = +left;
    	} else if (+left < +midle) {
    		var max = +midle;
    	} else if (+midle > +right) {
    		var max = +midle;
    	} else if (+midle < +right) {
    		var max = +right;
    	} else if (+left > +right) {
    		var max = +left;
    	} else if (+left < +right) {
    		var max = +right;
    	}*/

        $('#slider').nivoSlider();
        // var isi = $('.content-title').height();
        // var panjang = /*0.433 * */ $('.content-left').height();
        // var panjang2 = 0.997 *  $('.content-left').height();
        // var panjang3 = $('.content-left').height() - +isi -32;
        // $('.content-left').css('height',+panjang);
        // $('.kolom-midle').css('height',+panjang2);
        // $('.content-isi').css('height',+panjang3);
        // $('.kolom-right').css('height',+panjang);
    });
    </script>
</body>
</html>