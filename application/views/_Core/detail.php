<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Core 이야기
            <small>
                작성일:<?php echo date ("Y-m-d",strtotime($item->updated));?>,
                작성자:<?php echo $item->username ?>
            </small>
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="gq-detail-title">제목</div>
                <h3 class="box-title">
                    <?php echo $item->title ?>
                </h3>
            </div>
            <div class="box-body">
                <div class="gq-detail-title">간략한 설명</div>
                <?php echo $item->summary ?>
            </div>
            <div class="box-footer">
                <div class="gq-detail-title">내</div>
                <?php echo $item->content ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php
                if ($item->isdeprecated) {
                ?>
                    <a class="btn btn-danger pull-right"
                       href="<?= site_url('core/change_isdeprecated?coreid=' .$item->_coreid) .'&isdeprecated=false'?>">
                        <i class="fa fa-credit-card"></i> 살리기
                    </a>
                <?php
                } else {
                ?>
                    <a class="btn btn-success pull-right"
                       href="<?= site_url('core/change_isdeprecated?coreid=' .$item->_coreid) .'&isdeprecated=true'?>">
                        <i class="fa fa-credit-card"></i> 숨기기
                    </a>

                <?php
                }
                ?>

                <a class="btn btn-primary pull-right" style="margin-right: 5px;" href="<?= site_url('core/index')?>">
                    <i class="fa fa-download"></i>목록보기
                </a>
            </div>
        </div>
    </section>

</div>