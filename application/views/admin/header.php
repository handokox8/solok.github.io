<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/image/style.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/fancybox/jquery.fancybox-1.3.4.css">
		<link rel="shortcut icon" href="<?php echo base_url('assets/image/logo-jogjahost.png'); ?>" />

		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-latest.js'); ?>"></script>

		<script type="text/javascript" charset="utf-8">
			function extractPageName(hrefString)
			{
				var arr = hrefString.split('/');
				return  (arr.length<2) ? hrefString : arr[arr.length-2].toLowerCase() + arr[arr.length-1].toLowerCase();               
			}

			function setActiveMenu(arr, crtPage)
			{
				for (var i=0; i<arr.length; i++)
				{
					if(extractPageName(arr[i].href) == crtPage)
					{
						if (arr[i].parentNode.tagName != "div")
						{
							arr[i].className = "aktif";
							arr[i].parentNode.className = "aktif";
						}
					}
				}
			}

			function setPage()
			{
				hrefString = document.location.href ? document.location.href : document.location;

				if (document.getElementById("navigasi")!=null)
					setActiveMenu(document.getElementById("navigasi").getElementsByTagName("a"), extractPageName(hrefString));
			}
		</script>

		<!--ACCORDION DD MULAI-->
		<script type="text/javascript" src="<?php echo base_url('assets/js/ddaccordion.js'); ?>">

		/***********************************************
		* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
		* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
		* This notice must stay intact for legal use
		***********************************************/

		</script>


		<script type="text/javascript">
		var site_url = '<?php echo base_url(); ?>'
		ddaccordion.init({
			headerclass: "submenuheader", //Shared CSS class name of headers group
			contentclass: "submenu", //Shared CSS class name of contents group
			revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
			mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
			collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
			defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
			onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
			animatedefault: false, //Should contents open by default be animated into view?
			persiststate: true, //persist state of opened contents within browser session?
			toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
			togglehtml: ["suffix", "<img src='"+site_url+"assets/image/plus.gif' class='statusicon' />", "<img src='"+site_url+"assets/image/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
			animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
			oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
				//do nothing
			},
			onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
				//do nothing
			}
		})
		</script>

		<!--ACCORDION DD SELESAI-->

		<script type="text/javascript">
		function toggle2(showHideDiv, switchTextDiv) {
			var ele = document.getElementById(showHideDiv);
			var text = document.getElementById(switchTextDiv);
			if(ele.style.display == "block") {
		    		ele.style.display = "none";
				text.innerHTML = "<i class='icon-ok-sign icon-large'></i>";
		  	}
			else {
				ele.style.display = "block";
				text.innerHTML = "<i class='icon-remove-sign icon-large'></i>";
			}
		}
		</script>

	</head>
	<body>
		<style type="text/css">
	    #con-load{
	      position: absolute;
	        width: 100%;
	        height: 100%;
	        background: rgba(51,51,51,0.5);
	        z-index: 999;
	    }
	    #loading {
	        position: absolute;
	        top: 50%;
	        left: 50%;
	        margin-left:-70px;
	        margin-top:-50px;
	        z-index: 999; 
	    }
	    </style>
	    <div id="con-load" style="display:none;">
	      <div id="loading"><img src="<?php echo base_url('assets/image/loading.gif'); ?>" alt="Loading!" /></div>
	    </div>
		<div id="container">
			<div id="header">
				<div id="logo">
					<a href="<?php echo base_url('ngadmin/dashboard') ?>"><img src="<?php echo base_url('assets/image/logo.png'); ?>" alt=""></a>
				</div>
				<div id="nav">
					<a href="<?php echo base_url(); ?>" class="btn" target="_blank"><i class=" icon-share-alt"></i>lihat website</a>				
					<a href="<?php echo base_url('ngadmin/logout/'.$this->session->userdata('idPengguna').'/'.$this->session->userdata('pengguna')); ?>" class="btn"><i class="icon-off"></i>Keluar</a>
				</div>
			</div>
			<div id="post">