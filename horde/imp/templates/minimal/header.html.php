<?php
 $this->todate = strftime($GLOBALS['prefs']->getValue('date_format')).' - '.htmlspecialchars($GLOBALS['injector']->getInstance('Horde_Core_Factory_Identity')->create()->getDefaultFromAddress(true));
//$this->msgdate =$msg_headers->addHeader('Date', date('r'));
//$this->msgdate = $imp_ui->getDate(isset($ob['envelope']->date) ? $ob['envelope']->date : null);

$this->msgdate =$envelope->date;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> GMS | Light</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="/imp/ega_customs/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        
        <!-- bootstrap wysihtml5 - text editor -->
        <!-- <link href="css/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="/imp/ega_customs/css/iCheck/minimal/blue.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="/imp/ega_customs/css/master.css" rel="stylesheet" type="text/css" />
        <link href="/imp/ega_customs/css/main.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="#" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Government Mailing System
            </a>    <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
            
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <!--<li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i id="mail" class="icon"></i>
                                <span class="label label-danger">4</span>
                            </a>
                        </li>
                        -->
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#">
                                <i id="" class=""></i>
                                <span>  <?php echo $this->todate; ?></i></span>
                            </a>
                        </li>
                        
                        <li class="dropdown user user-menu">
                            
                                
                                <?php $cm = count($this->menu); $i = 0;$j = 1; ?>
<!-- Line below is Added by eGA Programmer -->
<?php if(is_array($this->menu)):  //checking if menu is array ?>
<?php foreach ($this->menu as $val): ?>
<?php if($cm == $j): ?>

<a accesskey="<?php echo $i ?>" href="<?php echo $val[1] ?>"> 
<i id="logout" class="icon"></i>
 <span class=""> <?php echo $this->h($val[0]) ?></i></span>
 </a>
<?php endif; $j++;$i++; endforeach; ?>
<?php endif;  //Close of line by eGA ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

