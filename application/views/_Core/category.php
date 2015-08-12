<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            GOQUAL CATEGORY
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
                                <th>카테고리</th>
                                <th>삭제</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($items as $item) {
                                ?>
                                <tr>
                                    <td><?php echo $item->_categoryid ?></td>
                                    <td><?php echo $item->label ?></td>
                                    <td>
                                        <?php
                                        if ($item->isdeprecated) {
                                            ?>
                                            <a href="<?= site_url('core/change_category_isdeprecated?categoryid=' . $item->_categoryid) . '&isdeprecated=false' ?>"
                                               class="gq-item-survive">
                                                살리기
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?= site_url('core/change_category_isdeprecated?categoryid=' . $item->_categoryid . '&isdeprecated=true') ?>"
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
                <a href="<?= site_url('/core/create_category') ?>" class="btn btn-primary pull-right">
                    <i class="fa fa-download"></i> 추가하기
                </a>
            </div>
        </div>
    </section>

</div>