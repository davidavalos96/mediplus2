<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">


<?php 
			Html ::  page_meta('theme-color',META_THEME_COLOR);
			Html ::  page_meta('author',META_AUTHOR); 
			Html ::  page_meta('keyword',META_KEYWORDS); 
			Html ::  page_meta('description',META_DESCRIPTION); 
			Html ::  page_meta('viewport',META_VIEWPORT);
			Html ::  page_css('font-awesome.min.css');
			Html ::  page_css('animate.css');
			Html ::  page_css('blueimp-gallery.css');
			Html ::  page_css('selectize.css');

?>
	<title><?php echo $this->report_title; ?></title>

	<?php 
		$style="	<style>@font-face {
			font-family: 'OpenSans-Regular';
			font-style: normal;
			font-weight: normal;
			src: url(http://" . $_SERVER['SERVER_NAME']."/mediplus/assets/fonts/OpenSans-Regular.ttf) format('truetype');
		  }</style";

		  echo $style;
	?>

	<style>
	
	@page{
		margin-bottom:3cm;
		margin-top:5cm;
	}
	

		.saltoLinea{
			border-bottom:1px solid black;
		}
	
		.oculto{
				display:none;
			}
		body,
		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			margin: 0px;
			padding: 0px;
			font-family: "Comic Sans MS", "Comic",cursive;
			font-style: inherit;
			
		}

		input[type=checkbox] { 
            vertical-align: middle; 
            position: relative; 
            bottom: 1px; 
        } 
          
        label { 
            display: block; 
        } 


		small {
			font-size: 13px;
			color: black;
		}

		span{
			font-size:15px;

		}

		.ajax-page-load-indicator {
			display: none;
			visibility: hidden;
			
		}

		#report-header{
			position:fixed;
			top:-4cm;
			border-bottom:2px solid green;
			margin-bottom:3cm;
		}
	


		#report-title {
			background: #FFFF;
			font-size: 24px;
			text-align:center;
			margin-bottom:20px;	
		}
		

		#report-footer { position:fixed;bottom:-1cm;border-top:2px solid green;text-align:center;font-size:13px;width:100%!important;}


		table,
		.table {
			width:100%;
			margin-right:0.5rem;
			border-collapse: collapse;
			border:1px solid black;
		}
		.td-sno{
			width:4%;
		}
		table th{
			border:0.5px solid black!important;
			font-size:12px;
		}

		table td,th{
			border: 0.5px solid black;
			

		}
		table td{
			font-size:13px;
		}
		.table-report td,th{
			border:hidden !important;
			padding-top:0px!important;
			text-align:center!important;
			width:100%;
		}		


		
	</style>
</head>

<body>
	<header id="report-header">
		<img src="<?php echo SITE_ADDR;?>/assets/images/LogoReporte.png" style="padding-bottom:10px;width:120px;height:90px;">

	</header>

	<div id="report-title"><?php echo $this->report_title; ?></div>
	<div id=" report-footer">
	<table class="table-report table-sm" style="font-family:'Comic Sans MS';padding-top:10px;border:hidden;width:100%;font-size:14px;color: #ff0066;">
			<tr>
				<td width="100%" style="text-align:center;">
				Av. Polonia N°936  |  B° Pueyrredón  |  Comodoro Rivadavia – Chubut (C.P.: 9000)<br>
				Tel.: 0297-4487660  |  E-mail: info@centropilares.com

				</td>
			</tr>
		</table>
	</div>

	<div id="report-body">
		<?php
		$this->render_body();
		?>
	</div>
	


	<?php 
		if($this->force_print){
			?>
			<script>
				window.print();
			</script>
			<?php
		}
	?>
</body>

</html>