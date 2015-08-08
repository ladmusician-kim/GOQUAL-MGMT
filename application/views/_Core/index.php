<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CORE
            <small>회사 전반적인 이야기</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="data-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>제목</th>
                                    <th>작성자</th>
                                    <th>작성일</th>
                                    <th>삭제하기</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($cores as $item) {
                            ?>
                                    <tr>
                                        <td><?php echo $item->_coreid ?></td>
                                        <td><a href="<?= site_url('/core/detail?coreid='. $item->_coreid) ?>">
                                                <?php echo $item->title ?>
                                            </a></td>
                                        <td><?php echo $item->username?></td>
                                        <td><?php echo date ("Y-m-d",strtotime($item->updated));?></td>
                                        <td><a>숨기기</a></td>
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
                <a href="<?= site_url('/core/create')?>" class="btn btn-primary pull-right">
                    <i class="fa fa-download"></i> 글쓰기
                </a>
            </div>
        </div>
    </section>

</div>