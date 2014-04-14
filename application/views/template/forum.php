		<!--KONTEN UTAMA MULAI-->
	<div id="bodi-background">
		<div class="content-left" style="margin-top:10px;">
			 <?php $this->load->view('template/sidebar'); ?>
			</div>
			 <div id="content">
			 	<div class="content-title">
			 		<h2><?php echo $title; ?></h2>
			 	</div>
			 	<?php
			 	if($forum_all == "NULL"){
			 		echo 'tidak ada forum ditampilkan';
			 	} else {
			 		foreach ($forum_all as $forum) {
			 			?>
			 			<ul class="content-list">
	                        <li>
	                			<a href="<?php echo base_url('forum/detil/'.$forum->idForum.'/'.$forum->title); ?>"><?php echo $forum->title; ?></a>
	                			<div class="tanggal">
                                			<?php 
                                			$namahari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
                                			$tgl = $forum->tanggal;
                                			$a=explode('-', $tgl);
                                			$b=explode(' ',$a[2]);
                                			$tanggal = $b[0].'-'.$a[1].'-'.$a[0].' '.$b[1];

                                			echo $tanggal; ?>

                                			</div>
	                       		<div class="content-line"></div>
	                			<p>
	                        	<?php echo word_limiter(strip_tags($forum->post), 45); ?>
	                       		</p>
	                        </li>
	                    </ul>
			 			<?php
			 		}
			 	}
			 	?>

                    <div class="clear"></div>
                    <div style="margin-top:10px" class="content-line"></div>
				 <div class="clear"></div>

			 </div>
		</div>
	<div class="clear">

		<!--KONTEN UTAMA SELESAI-->
		<div class="clear"></div>