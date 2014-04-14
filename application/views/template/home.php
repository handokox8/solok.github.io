<?php $this->load->view('template/header'); ?>
        <div class="home-bg">
          <div id="bodi-bg">
            <div class="clear"></div>
            <div id="slide-nivo">
                <div class="slider-wrapper theme-default">
                    <div id="slider" class="nivoSlider">
                    <?php if($slider_all == "NULL"){ ?>
                        <img src="<?php echo base_url('assets/template/image/images.jpg'); ?>" alt="">
                    
                    <?php } else {
                        foreach ($slider_all as $slider) { ?>
                            <img src="<?php echo base_url('assets/gambar/slider/'.$slider->filename); ?>" alt="">
                        <?php } } ?>  
                        </div>
                    <span class="shadowHolderflat"><img src="<?php echo base_url('assets/template/images/big-shadow5.png'); ?>" alt=""></span>
                    <div id="htmlcaption" class="nivo-html-caption">
                        <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
                    </div>
                </div>
            </div>
        <div class="sep_lines"></div><!-- separator line -->
        <div class="promo-box">
            <p>Selamat datang di website Bappeda Kota Solok </p>      
        </div>  
        <div class="clear"></div>
        <div class="content-left">
         <?php $this->load->view('template/sidebar'); ?>
         </div>
        <?php //kolom 1 ?>
        <div class="box-kolom-midle">
           
                <div class="kolom-midle">
                    <h2><?php echo $judulKolom1;?></h2>
                <?php
                 if($getkolom1== NULL){
                     echo 'Belum Ada Konten';
                    } else {
                         foreach ($getkolom1 as $getkolom1) {
                         ?>
                    <!--looping Konten depan mulai-->
                            <div class="kolom-midle-judul"> 
                               <a href="<?php echo base_url('news/index/'.$getkolom1->idNews.'/'.preg_replace("![^a-z0-9]+!i", "-", $getkolom1->$Djudul1)) ?>"><?php echo word_limiter(strip_tags($getkolom1->$Djudul1),5); ?></a>
                             </div>
                             <div class="kolom-midle-isi">
                                <p> <?php echo word_limiter(strip_tags($getkolom1->news),15); ?></p>
                             </div> 

                    <!--looping Konten depan mulai-->
                        <?php }} ?>
                </div>

           

             <?php //kolom 2 ?>
           
                <div class="kolom-midle">
                    <h2><?php echo $judulKolom2;?></h2>
                <?php
                 if($getkolom2== NULL){
                     echo 'Belum Ada Konten';
                    } else {
                         foreach ($getkolom2 as $getkolom2) {
                         ?>
                    <!--looping Konten depan mulai-->
                            <div class="kolom-midle-judul"> 
                               <a href="<?php echo base_url('news/index/'.$getkolom2->idNews.'/'.preg_replace("![^a-z0-9]+!i", "-", $getkolom2->$Djudul2)) ?>"><?php echo word_limiter(strip_tags($getkolom2->$Djudul2),5); ?></a>
                             </div>
                             <div class="kolom-midle-isi">
                                <p> <?php echo word_limiter(strip_tags($getkolom2->news),15); ?></p>
                             </div> 

                    <!--looping Konten depan mulai-->
                        <?php }} ?>
                </div>

            </div>
           

    <div class="clear"></div>
    </div>
     <?php $this->load->view('template/sidebar2'); ?>
    <div class="clear"></div>
    <div class="sparator-btm" style="margin-top:-10px;">
        <img src="<?php echo base_url('assets/template/images/sparator-btm.png'); ?>" style="margin:0 auto;" width="960" height="7px">
    </div>
    
</div>
<?php $this->load->view('template/footer'); ?>