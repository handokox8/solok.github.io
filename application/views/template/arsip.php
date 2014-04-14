		<!--KONTEN UTAMA MULAI-->
	<div id="bodi-background">
		<div class="content-left" style="margin-top:10px;">
			 <?php $this->load->view('template/sidebar'); ?>
			</div>
			 <div id="content">
			 	<div class="content-title">
			 		<h2><?php echo $title; ?></h2>
			 	</div>
			 	 <ul class="content-isi">
                <?php
                 if(isset($news_all)){
					if($news_all == "NULL"){
						echo 'tidak ada Konten';
					} else {
                         foreach ($news_all as $news) {
                         ?>	
                                   <ul class="content-list">
                                        <li>
                                			<a href="<?php echo base_url('news/index/'.$news->idNews.'/'.preg_replace("![^a-z0-9]+!i", "-", $news->title)); ?>"><?php echo word_limiter(strip_tags($news->title), 8); ?></a>
                                			<div class="tanggal">
                                			<?php 
                                			$namahari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
                                			$tgl = $news->tanggal;
                                			$a=explode('-', $tgl);
                                			$tanggal = $a[2].'-'.$a[1].'-'.$a[0];

                                			echo $tanggal; ?>

                                			</div>
                                       		<div class="content-line"></div>
                                			<?php if($news->image != "") { ?>
                                			<div class="thumb">
                                        		<img src="<?php echo base_url('assets/uploads/'.$news->image); ?>">
                                        	</div>
                                        	 
                                        	<?php } ?>
                                			<p>
                                        	<?php echo word_limiter(strip_tags($news->news), 30); ?>
                                       		</p>
                                       		<div class="clear"></div>
                                       		 <div style="margin-top:10px" class="content-line"></div>
                                        </li>
                                    </ul>

                                    <div class="clear"></div>
                                   
                        <?php }} ?>
                         	   
        		 
        		 <?php } ?>
				 <div class="clear"></div>

				  <?php
				if(isset($semua_lokasi)){
                 if($semua_lokasi == NULL){
						echo 'tidak ada lokasi';
							} else {
						foreach ($semua_lokasi as $all_lokasi) {
											?>
                                   <ul class="content-list">
                                        <li>
                                			<a href="<?php echo base_url('news/index/'.$all_lokasi->idNews.'/'.preg_replace("![^a-z0-9]+!i", "-", $all_lokasi->title)); ?>"><?php echo word_limiter(strip_tags($all_lokasi->title), 8); ?></a>
                                			<div class="tanggal">
                                			<?php 
                                			$namahari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
                                			$tgl = $all_lokasi->tanggal;
                                			$a=explode('-', $tgl);
                                			$tanggal = $a[2].'-'.$a[1].'-'.$a[0];

                                			echo $tanggal; ?>
                                			</div>
                                			<div class="content-line"></div>
                                			<?php if($all_lokasi->image != "") { ?>
                                			<div class="thumb">
                                        		<img src="<?php echo base_url('assets/uploads/'.$all_lokasi->image); ?>">
                                        	</div>
                                        	
                                        	<?php } ?>
                                			<p>
                                        		<?php echo word_limiter(strip_tags($all_lokasi->news), 30); ?>
                                       		</p>
                                       		 <div class="clear"></div>
                                       		 <div style="margin-top:10px" class="content-line"></div>
                                       		 
                                        </li>
                                    </ul>
                                    <div class="clear"></div>
                                   
                        <?php }} ?>
        		 	
        		 <?php } ?>

			 </div>
		</div>
	<div class="clear">
	
		<div class="halaman-wrapper">
		<?php echo $this->pagination->create_links(); ?>
		</div>

		<!--KONTEN UTAMA SELESAI-->
		<div class="clear"></div>