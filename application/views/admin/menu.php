                 <style type="text/css">
                /*===================================================
                    .   NAVIGASI
                ===================================================*/
                .navigasi {
                }
                .navigasi a {
                    text-decoration: none;
                    color: #147DCF;

                }
                .navigasi ul li {
                    background: #d1d1d1;
                    border: solid 1px #b8b8b8;
                    border-radius: 5px;
                    padding: 10px;
                    margin: 8px;
                    list-style: none;
                    color: #333;
                }
                .navigasi ul li ul {
                    background: none;
                }
                .navigasi ul li ul > li {
                    background: red
                }
                .navigasi ul li ul li {
                    margin: 10px;
                    background: green
                }

                </style>
                <div id="content">
                    <div class="content">
                        <div class="judul">
                            <h2>Dashboard</h2>
                            <p>Selamat Datang di ngAdmin panel versi 1.0</p>
                        </div>

                        <?php if($this->session->flashdata('flashOK')): ?>
                        <div id="notif" class="sukses">
                            <p><i class="icon-ok icon-large"></i><?php echo $this->session->flashdata('flashOK'); ?></p>
                        </div>
                        <?php endif ?>
                        <?php if($this->session->flashdata('flashNO')): ?>
                        <div id="notif" class="peringatan">
                            <p><i class="icon-exclamation-sign icon-large"></i><?php echo $this->session->flashdata('flashNO'); ?></p>
                        </div>
                        <?php endif ?>
                        <?php if($this->session->flashdata('flashNOP')): ?>
                        <div id="notif" class="peringatan">
                            <?php echo $this->session->flashdata('flashNOP'); ?>
                        </div>
                        <?php endif ?>

                        <div id="notif" class="peringatan">
                            <?php echo form_error('url'); ?>
                            <?php echo form_error('label'); ?>
                            <?php echo form_error('urut'); ?>
                        </div>

                        <div class="twin-wrapper">
                            <div class="twinner">
                                <div class="twin-container twin30 twin-awal">
                                    <div class="twin">  
                                        <div class="title">
                                            <h3><?php echo "Tambah Link" ?></h3>
                                        </div>                              
                                        
                                        <div class="twin-isi">
                                            <div class="isis">
                                                <?php echo form_open(base_url($path)); ?>
                                                    <table style="width: 100%">
                                                        <tbody>
                                                            <tr>
                                                                <td class="bella">URL</td>
                                                                <td class="isi"><?php echo form_input(array('name'=>'url', 'class'=>'input-full', 'placeholder'=>'http://','value'=>$url)); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bella">Label</td>
                                                                <td class="isi"><?php echo form_input(array('name'=>'label', 'class'=>'input-full','value'=>$label)); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bella">Parent to</td>
                                                                <td class="isi">
                                                                    <select name="parent" class="dropdown" style="width:100%;">
                                                                        <option value="">[ parent to ]</option>
                                                                        
                                                                        <option value="">[ Tanpa Parent ]</option>
                                                                            <?php
                                                                            if($parent_head == "NULL"){
                                                                                ?><option value="">Belum ada Menu</option><?php
                                                                            } else {
                                                                                foreach ($parent_head as $ph) {
                                                                                    ?><option value="<?php echo $ph->id_menu; ?>"<?php echo ($ph->id_menu == $idmenu) ? 'selected' : '' ?>><?php echo $ph->title; ?></option><?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                    <?php
                                                                    ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bella">Urutan</td>
                                                                <td class="isi"><?php echo form_input(array('name'=>'urut', 'class'=>'input-full', 'value'=>$urut, 'placeholder'=>'urutan tata letak menu')); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Simpan')) ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                <?php echo form_close(); ?>         
                                            </div>
                                        </div>
                                    </div>
                                      <? //tambahan box menu halaman ?>
                                    <div class="twin">  
                                        <div class="title">
                                            <h3>Halaman</h3>
                                        </div>                              
                                        
                                        <div class="twin-isi">
                                            <div class="isis">
                                                <?php echo form_open(base_url('menu/add_halaman')); ?>

                                                    <?php if($add_halaman=='NULL'){ 
                                                        echo "Belum Ada Halaman";
                                                     }else{ ?>

                                                    <table style="width: 100%">
                                                        <tbody>
                                                            <?php $i=1; foreach($add_halaman as $halaman) { ?>
                                                            <tr>
                                                                <td><label><?php echo form_checkbox(array('name'=>'halaman'.$i,'id'=>'halaman'.$i, 'class'=>'checkbox' ,'value'=>$halaman->idPages)); ?><?php echo ucwords($halaman->title)?></label></td>
                                                            </tr>
                                                            <?php $i++; } ?>
                                                            <tr>
                                                                <td colspan="2"><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Tambah')) ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                        <input type="hidden" name="jumHal" value="<?php echo $i-1; ?>">
                                                        <?php } ?>
                                                <?php echo form_close(); ?>         
                                            </div>
                                        </div>
                                    </div>
                                    <div class="twin">  
                                        <div class="title">
                                            <h3>Label</h3>
                                        </div>                              
                                        
                                        <div class="twin-isi">
                                            <div class="isis">

                                                <?php echo form_open(base_url('menu/add_label')); ?>
                                                    <?php if($add_label == 'NULL'){ 
                                                        echo "Belum Ada Label";
                                                     }else{ ?>
                                                     
                                                    <table style="width: 100%">
                                                        <tbody>
                                                            <?php $i=1; foreach ($add_label as $label) { ?>
                                                            <tr>
                                                                <td><label><?php echo form_checkbox(array('name'=>'label'.$i,'id'=>'label'.$i, 'class'=>'checkbox' ,'value'=>$label->idLabel)); ?><?php echo ucwords($label->label)?></label></td>
                                                            </tr>
                                                            <?php $i++; } ?>
                                                            <tr>
                                                                <td colspan="2"><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Tambah')) ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                         <input type="hidden" name="jumLab" value="<?php echo $i-1 ?>">
                                                          <?php } ?>
                                                <?php echo form_close(); ?>         
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="twin-container twin70 twin-akhir">
                                    <div class="twin">  
                                        <div class="title">
                                            <h3>Sturktur menu</h3>
                                        </div>                              
                                        <div class="twin-isi">
                                            <div class="isis">
                                                <?php
                                                if($menu == NULL){
                                                    echo 'Menu belum tersedia';
                                                } else { ?>
                                                <div class="navigasi">
                                                    <?php echo $menu; ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                            <div class="clear"></div>
<!-- 
                            <? //tambahan box menu halaman ?>

                             <div class="twinner">
                                <div class="twin-container twin30 twin-awal">
                                    <div class="twin">  
                                        <div class="title">
                                            <h3>Halaman</h3>
                                        </div>                              
                                        
                                        <div class="twin-isi">
                                            <div class="isis">
                                                <?php echo form_open(base_url('menu/add_halaman')); ?>

                                                    <?php if($add_halaman=='NULL'){ 
                                                        echo "Belum Ada Halaman";
                                                     }else{ ?>

                                                    <table style="width: 100%">
                                                        <tbody>
                                                            <?php $i=1; foreach($add_halaman as $halaman) { ?>
                                                            <tr>
                                                                <td><label><?php echo form_checkbox(array('name'=>'halaman'.$i,'id'=>'halaman'.$i, 'class'=>'checkbox' ,'value'=>$halaman->idPages)); ?><?php echo ucwords($halaman->title)?></label></td>
                                                            </tr>
                                                            <?php $i++; } ?>
                                                            <tr>
                                                                <td colspan="2"><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Tambah')) ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                        <input type="hidden" name="jumHal" value="<?php echo $i-1; ?>">
                                                        <?php } ?>
                                                <?php echo form_close(); ?>         
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             <div class="clear"></div>


                              <? //tambahan box menu label ?>

                             <div class="twinner">
                                <div class="twin-container twin30 twin-awal">
                                    <div class="twin">  
                                        <div class="title">
                                            <h3>Label</h3>
                                        </div>                              
                                        
                                        <div class="twin-isi">
                                            <div class="isis">

                                                <?php echo form_open(base_url('menu/add_label')); ?>
                                                    <?php if($add_label == 'NULL'){ 
                                                        echo "Belum Ada Label";
                                                     }else{ ?>
                                                     
                                                    <table style="width: 100%">
                                                        <tbody>
                                                            <?php $i=1; foreach ($add_label as $label) { ?>
                                                            <tr>
                                                                <td><label><?php echo form_checkbox(array('name'=>'label'.$i,'id'=>'label'.$i, 'class'=>'checkbox' ,'value'=>$label->idLabel)); ?><?php echo ucwords($label->label)?></label></td>
                                                            </tr>
                                                            <?php $i++; } ?>
                                                            <tr>
                                                                <td colspan="2"><?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-grey', 'value'=>'Tambah')) ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                         <input type="hidden" name="jumLab" value="<?php echo $i-1 ?>">
                                                          <?php } ?>
                                                <?php echo form_close(); ?>         
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
 -->

                        </div>
                    

                    </div>
                </div>