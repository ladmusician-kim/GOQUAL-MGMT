<div class="content-wrapper">
    <section class="content-header">
        <h1>
            보도자료
            <small>
                작성일: <?php echo date("Y-m-d", strtotime($item->updated)); ?>,
                작성자: <?php echo $item->username ?>
            </small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">발행기관</label>

                                <div class="col-sm-11 gq-item-content">
                                    <?php echo $item->institution ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">발행일</label>

                                <div class="col-sm-11 gq-item-content">
                                    <?php echo date("Y-m-d", strtotime($item->published)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-1 control-label">제목</label>

                                <div class="col-sm-11 gq-item-content">
                                    <?php echo $item->title ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">간단한 설명</label>

                                <div class="col-sm-11 gq-item-content">
                                    <?php echo $item->summary ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">URL</label>

                                <div class="col-sm-11 gq-item-content">
                                    <?php echo $item->url ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">기사내용</label>

                                <div class="col-sm-11 gq-item-content">
                                    <iframe src="<?php echo $item->url ?>" width="100%" height="600px"></iframe>
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
                               href="<?= site_url('report/change_isdeprecated?reportid=' . $item->_reportid) . '&isdeprecated=false' ?>">
                                <i class="fa fa-credit-card"></i> 살리기
                            </a>
                            <?php
                        } else {
                            ?>
                            <a class="btn btn-success pull-right"
                               href="<?= site_url('report/change_isdeprecated?reportid=' . $item->_reportid) . '&isdeprecated=true' ?>">
                                <i class="fa fa-credit-card"></i> 숨기기
                            </a>

                            <?php
                        }
                        ?>

                        <a class="btn btn-warning pull-right" style="margin-right: 5px;"
                           href="<?= site_url('report/update?reportid=' . $item->_reportid) ?>">
                            <i class="fa fa-file-excel-o"></i>수정하기
                        </a>
                        <a class="btn btn-primary pull-right" style="margin-right: 5px;"
                           href="<?= site_url('report/index') ?>">
                            <i class="fa fa-download"></i>목록보기
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>