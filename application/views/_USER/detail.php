<div class="content-wrapper">
    <section class="content-header">
        <h1>
            회원
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-1 control-label">아이디</label>

                                <div class="col-sm-11 gq-item-content">
                                    <?php echo $item->username ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-1 control-label">이메일</label>

                                <div class="col-sm-11 gq-item-content">
                                    <?php echo $item->email ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">분류</label>

                                <div class="col-sm-11 gq-item-content">
                                    <?php echo $item->label ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">프로필</label>

                                <div class="col-sm-11 gq-item-content">
                                    <img src="<?php echo $item->profile_uri ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?php
                        if ($item->isdeprecated) {
                            ?>
                            <a class="btn btn-danger pull-right"
                               href="<?= site_url('user/change_isdeprecated?userid=' . $item->_id) . '&isdeprecated=false' ?>">
                                <i class="fa fa-credit-card"></i> 살리기
                            </a>
                            <?php
                        } else {
                            ?>
                            <a class="btn btn-success pull-right"
                               href="<?= site_url('user/change_isdeprecated?userid=' . $item->_id) . '&isdeprecated=true' ?>">
                                <i class="fa fa-credit-card"></i> 숨기기
                            </a>

                            <?php
                        }
                        ?>

                        <a class="btn btn-warning pull-right" style="margin-right: 5px;"
                           href="<?= site_url('user/update?userid=' . $item->_id) ?>">
                            <i class="fa fa-file-excel-o"></i>수정하기
                        </a>
                        <a class="btn btn-primary pull-right" style="margin-right: 5px;"
                           href="<?= site_url('user/index') ?>">
                            <i class="fa fa-download"></i>목록보기
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>