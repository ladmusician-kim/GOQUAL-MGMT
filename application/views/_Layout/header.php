<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GOQUAL</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="/static/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

    <link href="/static/lib/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <link href="/static/lib/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="/static/lib/admin/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
        $flashdata = $this->session->flashdata('message');
        if ($flashdata != null) {
            ?>

            <script type="text/javascript">
                alert('<?=$this->session->flashdata('message')?>');
            </script>
            <?php
        }
        ?>
        <header class="main-header">
            <a href="<?=site_url('/home/index')?>" class="logo">
                <span class="logo-lg"><b>GOQUAL</b></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#" data-toggle="control-sidebar">LOGOUT</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
