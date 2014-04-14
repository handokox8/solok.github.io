				<div id="sidebar">
					<div class="sidebar">
						<div class="welcome">
							<div class="tmb">
								<img src="<?php echo base_url('assets/gambar/profile/'.$this->session->userdata('images')); ?>" width="64" alt="tmb">
							</div>
							<div class="panel">
								<p>
									halo, <?php echo $this->session->userdata('pengguna'); ?>
								</p>
								<p>
									<a href="<?php echo base_url('ngadmin/setting_user/'.$this->session->userdata('idPengguna').'/'.$this->session->userdata('pengguna')); ?>">Pengaturan Pengguna</a>
								</p>
							</div>
						</div>

						<div class="glossymenu">
							<a class="menuitem" href="<?php echo base_url('ngadmin/dashboard'); ?>"><i class="icon-home"></i>  Dashboard</a>
							<a class="menuitem" href="<?php echo base_url('news/get_news'); ?>"><i class="icon-file"></i>  Konten</a>
							<a class="menuitem" href="<?php echo base_url('admin_pages/'); ?>"><i class="icon-copy"></i>  Halaman</a>
							<a class="menuitem" href="<?php echo base_url('gallery/'); ?>"><i class="icon-camera"></i>  Galeri</a>
							<a class="menuitem" href="<?php echo base_url('media/'); ?>"><i class="icon-picture"></i>  Media</a>
							
							<?php if($this->session->userdata('akses') == 'administrator'): ?>
							<a class="menuitem submenuheader" href=""><i class="icon-info-sign"></i>  Web info</a>
							
							<div class="submenu">
								<ul>
									
										<li><a href="<?php echo base_url('ngadmin/users'); ?>">Pengguna</a></li>
										<li><a href="<?php echo base_url('member/folower'); ?>">Member</a></li>
									

									<li><a href="<?php echo base_url('setting/logo'); ?>">Logo</a></li>
									<li><a href="<?php echo base_url('contact/'); ?>">Kontak</a></li>
									<li><a href="<?php echo base_url('sosial/setting_acount'); ?>">Social Media</a></li>
									<li><a href="<?php echo base_url('admin_info/'); ?>">Search Engine Optimization (SEO)</a></li>
								</ul>
							</div>
							
							<a class="menuitem submenuheader" href=""><i class="icon-wrench"></i>  Pengaturan</a>
							<div class="submenu">
								<ul>
									<li><a href="<?php echo base_url('label/get_label'); ?>">label</a></li>
									<li><a href="<?php echo base_url('menu/'); ?>">Menu</a></li>
									<li><a href="<?php echo base_url('feature/'); ?>">Fitur</a></li>
<!-- 									<li><a href="<?php echo base_url('client/'); ?>">Klien</a></li> -->
									<li><a href="<?php echo base_url('slider/'); ?>">Slider</a></li>
									<li><a href="<?php echo base_url('setting/banner'); ?>">Banner</a></li>
									<li><a href="<?php echo base_url('setting/link'); ?>">Tautan</a></li>
									<li><a href="<?php echo base_url('setting/footer'); ?>">Footer</a></li>
								</ul>
							</div>
							<a class="menuitem submenuheader" href=""><i class="icon-wrench"></i>  Pengaturan Tema</a>
							<div class="submenu">
								<ul>
									<li><a href="<?php echo base_url('widget/'); ?>">Widget</a></li>
									<!--<li><a href="<?php echo base_url('tema/'); ?>">Kolom</a></li>-->
									<li><a href="<?php echo base_url('forum/get_forum'); ?>">Forum</a></li>
								</ul>
							</div>
							<?php endif ?>
						</div>
						

					</div>
				</div>