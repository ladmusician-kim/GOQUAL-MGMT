<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            보도자료
            <small>회사에 관한 기사를 관리합니다</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="data-table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>제목</th>
                                <th>발행기관</th>
                                <th>발행일</th>
                                <th>삭제하기</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($reports as $item) {
                                ?>
                                <tr>
                                    <td><?php echo $item->_reportid ?></td>
                                    <td><a href="<?php echo base_url()?>report/detail?reportid=<?php echo $item->_reportid ?>">
                                            <?php echo $item->title ?>
                                        </a></td>
                                    <td><?php echo $item->institution ?></td>
                                    <td><?php echo date("Y-m-d", strtotime($item->published)); ?></td>
                                    <td>
                                        <?php
                                        if ($item->isdeprecated) {
                                            ?>
                                            <a href="<?= site_url('report/change_isdeprecated?reportid=' . $item->_reportid) . '&isdeprecated=false' ?>"
                                               class="gq-item-survive">
                                                살리기
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?= site_url('report/change_isdeprecated?reportid=' . $item->_reportid . '&isdeprecated=true') ?>"
                                               class="gq-item-delete">
                                                숨기기
                                            </a>

                                            <?php
                                        }
                                        ?>

                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="<?= site_url('/report/create') ?>" class="btn btn-primary pull-right">
                    <i class="fa fa-download"></i> 글쓰기
                </a>
            </div>
        </div>
    </section>

</div>