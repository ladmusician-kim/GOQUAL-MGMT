<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            USER
            <small>회원</small>
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
                                <th>이메일</th>
                                <th>아이디</th>
                                <th>분류</th>
                                <th>최근 로그인</th>
                                <th>삭제하기</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($users as $item) {
                                ?>
                                <tr>
                                    <td><?php echo $item->_id ?></td>
                                    <td><a href="<?= site_url('/user/detail?userid=' . $item->_id) ?>">
                                            <?php echo $item->email ?>
                                        </a></td>
                                    <td><?php echo $item->username ?></td>
                                    <td><?php echo $item->label ?></td>
                                    <td><?php if($item->logined) echo date("Y-m-d", strtotime($item->logined)); ?></td>
                                    <td>
                                        <?php
                                        if ($item->isdeprecated) {
                                            ?>
                                            <a href="<?= site_url('user/change_isdeprecated?userid=' . $item->_id) . '&isdeprecated=false' ?>"
                                               class="gq-item-survive">
                                                살리기
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="<?= site_url('user/change_isdeprecated?userid=' . $item->_id . '&isdeprecated=true') ?>"
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
                <a href="<?= site_url('/user/create') ?>" class="btn btn-primary pull-right">
                    <i class="fa fa-download"></i> 추가하기
                </a>
            </div>
        </div>
    </section>

</div>