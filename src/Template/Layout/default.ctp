<?php
if(!in_array($menuFind->id,$userRightsIds))
{
    $unAthorizedUrl=$this->Url->build(['controller'=>'Employees','action'=>'dashboard']);
    echo "<meta http-equiv='refresh' content='0;url=".$unAthorizedUrl."'/>";
    exit;
}
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= isset($head_title)?$head_title:'Jk IT Inventory Management' ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
		echo $this->Html->css([ 
						'/assets/css/bootstrap.min.css',
						'/assets/font-awesome/css/font-awesome.min.css',
                        '/assets/css/ionicons.min.css',
                        '/assets/css/font-nunito-sans.css',
                        '/assets/css/file-input.css',
                        '/assets/js/mCustomScrollbar/jquery.mCustomScrollbar.min.css',
						'/assets/js/bootstrap-toastr/toastr.min.css',
						'/assets/css/AdminLTE.css'
			]) ?>

            <?= $this->fetch('select2css'); ?>
            <?= $this->fetch('datepickercss'); ?>
            <?= $this->fetch('timepickercss'); ?>
            <?= $this->fetch('taginputcss'); ?>
            <?= $this->fetch('adminStyle'); ?>
		<style>
        .error{
            color: red;
        }
        .btnEdit{
            color:#00B17A!important;
        }
         /*.btnView{
            color:red !important;
        }*/
        .btnClass{
            margin-top: 20px;
            background-color: #00B17A!important;
            border-color: #00B17A !important;
        }
        .btnExport{
            margin-top: 20px;
            color:white;
            background-color: #1295AB!important;
            border-color: #1295AB !important;
        }
        .row{
            margin-bottom: 5px;
        }
        /*thead{
            background-color: #f1f1f1;
        }*/
        body {
            font-size: 13px !important;
            font-family: 'Poppins', sans-serif !important;
        }
        .box .box-body .table {
            margin-bottom: 20px !important;
            font-family: 'Poppins', sans-serif !important;
        }
		fieldset {
			padding: 5px ;
            margin-right: 15px;
            margin-left: 15px;
			border: 1px solid #e6e6e6 !important;
			border-radius:5px;
            font-family: 'Poppins', sans-serif !important;
		}
		legend{
			margin-left: 15px;
			color:#144277;
			font-size: 17px;
			margin-bottom:0px;
			border:none;
            font-family: 'Poppins', sans-serif !important;
		}
		.required {
			color:#a94442 !important;
		}
		img{
			border:none !important;
		}
	.btn-danger
	{
		background-color:#FB6542 !important;
		color:#FFF;
		border-color:#FB6542 !important;
        font-family: 'Poppins', sans-serif !important;
	}
	
	.form-group.has-error .form-control {
		border-color: #a94442 !important;
        font-family: 'Poppins', sans-serif !important;
	}
	.form-group.has-error label {
		color: #585858 !important;
        font-family: 'Poppins', sans-serif !important;
	}
    .capitalize
    {
        text-transform:capitalize;
    }
    .file-input{
        display: inline-block;
    }
    .fileinput-remove{
        display: inline-flex;
    }
    .file-preview-image
    {
        width: 100% !important;
        height:160px !important;
    }
    .file-preview-frame
    {
        display: contents;
        float:none !important;
    }
    .kv-file-zoom
    {
        display:none;
    }
    .link{
        color:#3c8dbc;
    }
    .link:hover{
        color:#3c8dbc;
    }
    .widgetText{
        font-size: 30px !important;
    }
    .box{
        padding-bottom: 13px;
    }
.content-scroll {
    width: 510px;
    height: 400px;
}
.mCSB_container_wrapper {
    margin-right: 0px !important;
    margin-bottom: 15px !important;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
    padding: 10px 10px 10px 10px !important;
}
.actions{
        width:12%;
}
th
{
    font-weight:400 !important;
}
.control-label
{
    font-weight:500 !important;
}

b,strong{
    font-weight: 600;
}
h1,h2,h3,h4,h5,h6{
    font-family: 'Poppins', sans-serif !important;
}
.modal-title{

        font-family: 'Poppins', sans-serif;
}

.object{
	width: 20px;
	height: 20px;
	background-color: #F15340;
	float: left;
	margin-right: 20px;
	margin-top: 65px;
	-moz-border-radius: 50% 50% 50% 50% !important;
	-webkit-border-radius: 50% 50% 50% 50% !important;
	border-radius: 50% 50% 50% 50% !important;
}
#loading{
	background-color: rgba(0, 0, 0, 0.21);
	height: 100%;
	width: 100%;
	position: fixed;
	z-index: 999999;
	margin-top: 0px;
	top: 0px;
	display:none;
}
#loading-center{
	width: 100%;
	height: 100%;
	position: relative;
}
#loading-center-absolute {
	position: absolute;
	left: 50%;
	top: 50%;
	height: 150px;
	width: 150px;
	margin-top: -75px;
	margin-left: -75px;
}

#object_one {	
	-webkit-animation: object_one 1.5s infinite;
	animation: object_one 1.5s infinite;
	}
#object_two {
	-webkit-animation: object_two 1.5s infinite;
	animation: object_two 1.5s infinite;
	-webkit-animation-delay: 0.25s; 
	animation-delay: 0.25s;
	}
#object_three {
	-webkit-animation: object_three 1.5s infinite;
	animation: object_three 1.5s infinite;
	-webkit-animation-delay: 0.5s;
	animation-delay: 0.5s;
	
	}
@-webkit-keyframes object_one {
75% { -webkit-transform: scale(0); }
}

@keyframes object_one {

  75% { 
	transform: scale(0);
	-webkit-transform: scale(0);
  }

}
@-webkit-keyframes object_two {
  75% { -webkit-transform: scale(0); }
}

@keyframes object_two {
  75% { 
	transform: scale(0);
	-webkit-transform:  scale(0);
  }

}

@-webkit-keyframes object_three {
  75% { -webkit-transform: scale(0); }
}

@keyframes object_three {

  75% { 
	transform: scale(0);
	-webkit-transform: scale(0);
  }
  
}
.deletebtn {
    border-radius: 50px !important;
    background-color: #FFE0E0 !important;
    border: none !important;
    padding: 5px 8px 5px 8px !important;
}
.pagination > li > a{
    color: #636365 !important;
	background-color:#F6F5F5 !important;
	border-color: #F6F5F5 !important;
	border-top: 1px solid #ddd !important;
	padding-top: 12px;
    padding-bottom: 12px;
    font-size: 14px;
}
.addrow{
    background-color: #00B17A !important;
    border-color: #00B17A !important;
}
.button{
  background-color: #00B17A !important;
  border-color: #00B17A !important;
  color:#FFFFFF !important;
  text-transform: uppercase;
  padding: 8px 30px 8px 30px;
  font-size: 16px;
  font-weight: 100;
}
/*.button:hover{
	color :#ffffff !important;
	background-color: #FF6468 !important;
}
*/.pagination>li {
    display: inline;
    color: #393636 !important;
    font-weight: 600;
}
.pagination > li > a:hover{
	background-color:#FF6468 !important;
	border-color: #FF6468 !important;
	color:#fff !important;
}
.actions{
 text-align:center !important; 
}
.viewbtn{
	border-radius: 50px;
    background-color: #FEF1D5 !important;
    border: none;
    padding: 5px 8px 5px 8px !important;
    margin-right: 2px;
    margin-top: 2px;
}
.viewbtn>i{
	    color: #F9CA66;
}
.editbtn{
    border-radius: 5px !important;
    background-color: #00B17A ! important;
    border: none !important;
    padding: 3px 5px 5px 5px !important;
    margin-right: 2px;
    margin-top: 2px;
    width:30px;
    height: 26px !important;
}
.btnView{
    border-radius: 5px !important;
    background-color: #FB6542  ! important;
    border: none !important;
    padding: 3px 5px 5px 5px !important;
    margin-right: 2px;
    margin-top: 2px;
    width:30px;
    height: 26px !important;
}
 .sizebtn{
    width:80px !important;
  }
		</style>
		<link rel="shortcut icon" href="<?php echo $this->Url->build('/img/favicon.png'); ?>"/>
       
    </head>
    <body class="skin-blue fixed" >
		<div id="loading">
			<div id="loading-center">
				<div id="loading-center-absolute">
					<div class="object" id="object_one"></div>
					<div class="object" id="object_two"></div>
					<div class="object" id="object_three"></div>
				</div>
			</div>
		</div>
        <!-- header logo: style can be found in header.less -->
        <header class="header" >
           <!--  <h3 style=" font-size: 18px;margin-left: 10px;">JK Institute Of Technology</h3> -->
           <?= $this->Html->image('/img/JKIT-logo.png',['style'=> 'height: 55px; background-color: #2C2948 !important;width: 220px;']); ?>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top navbar-fixed-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-left">
                    <h4 style="color: white; margin-left: 10px;margin-top: 15px;">
                        <?php //@$title ?>
                    </h4>
                </div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown user user-menu" >
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= $name ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu" style="width:190px !important;min-width: 125px !important;">
                            <li class="user-footer" style="background-color: #fff !important;">
                                <a href="<?php echo $this->Url->build(["controller" => "Employees",'action'=>'changePassword']); ?>" class="btn btn-info btn-flat"> Change Password </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
        <div class="wrapper row-offcanvas row-offcanvas-left" >
            <aside class="left-side sidebar-offcanvas" style="background-color: #2C2948 !important;padding-top: 30px;">
                <section class="sidebar" >
                    <ul class="sidebar-menu">
                       <?= $this->element('menu'); ?>
                    </ul>
                </section>
            </aside>
            <aside class="right-side">
					<section class="content" >
						<?= $this->Flash->render() ?>
						<?php echo $this->fetch('content'); ?>
					</section>
			</aside>
        </div>

        
        
    </body>
    <!-- <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script> -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> 
    <?= $this->Html->script([
                    '/assets/js/jquery.min.js',     
                    '/assets/js/jquery.slimscroll.min.js',
                    '/assets/js/mCustomScrollbar/jquery.mCustomScrollbar.concat.min',
                    '/assets/js/bootstrap-toastr/toastr.min.js',
                    '/assets/js/bootstrap-toastr/ui-toastr.js'
        ]); ?>

        <?= $this->fetch('page_level_js'); ?>
        <?= $this->fetch('select2js'); ?>
        <?= $this->fetch('datepickerjs'); ?>
        <?= $this->fetch('timepickerjs'); ?>
        <?= $this->fetch('fileinputjs'); ?>
        <?= $this->fetch('taginputjs'); ?>
        <?= $this->fetch('validatejs'); ?>
        <?= $this->fetch('block_js'); ?>
        <?= $this->fetch('editorJs'); ?>
   
       
        <?= $this->Html->script([
                    '/assets/js/jquery-ui-1.10.3.min.js',
                    '/assets/js/bootstrap.min.js',
                    '/assets/js/AdminLTE/app.js',
                    ]); ?>
        <?= $this->fetch('advancedFormjs'); ?>
<script type="text/javascript">
     /////////////  Selected Menu //////////
    $(window).load(function(){
        var menuSelect=$("a[href='<?php echo $this->request->getAttribute('here');  ?>']");
        menuSelect.parents('li').addClass('active');
    });
    ////////////////////////////////////
    window.onerror = function(msg, url, linenumber) {
        $('#loading').hide();
        return false;
    }
    
    var csrf = <?=json_encode($this->request->getParam('_csrfToken'))?>;
    $.ajaxSetup({
        headers: { 'X-CSRF-Token': csrf },
        error: function(){alert('ajex error')}
    });

    $( document ).ajaxError(function( event, request, settings ) {
      $( "head" ).append( "<li>Error requesting page " + settings.url + "</li>" );
    });

    $(document).on('submit','form',function(){
        $(this).find('button[type=submit]').addClass('disabled');
        $(this).find('button[type=submit]').text('Data Saving...');
    });

    $(window).load(function(){
    $.mCustomScrollbar.defaults.scrollButtons.enable=true; 
    $.mCustomScrollbar.defaults.axis='yx'; 
    $('.content-scroll').mCustomScrollbar({theme:'dark-3'});
   
});
    function round(value, exp) { 
      if (typeof exp === 'undefined' || +exp === 0)
        return Math.round(value);

      value = +value;
      exp = +exp;

      if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
        return 0;

      // Shift
      value = value.toString().split('e');
      value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

      // Shift back
      value = value.toString().split('e');
      return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
    }
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<?= $this->fetch('scriptPageBottom'); ?>
</html>