<div class="login-box">
    <div class="login-logo">
        <a href="<?=site_url('/home/index')?>"><b>GOQUAL</b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">진정한 고퀄인인가?</p>

        <form action="<?=site_url('/auth/login')?>" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="login_email"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="login_password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">로그인</button>
                </div>
            </div>
        </form>
    </div>
</div>