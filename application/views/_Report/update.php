<div class="content-wrapper">
    <section class="content-header">
        <h1>
            보도자료
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form class="form-horizontal" action="<?= site_url('/report/update_submit') ?>"
                          method="post" enctype="multipart/form-data">
                        <input type="hidden" name="reportid" value="<?php echo $reportid ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="institution" class="col-sm-1 control-label">뉴스 기관</label>

                                <div class="col-sm-11">
                                    <input type="text" name="institution" class="form-control"
                                           value="<?php echo $item->institution ?>"
                                           id="institution" placeholder="제목을 입력하세요">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="published" class="col-sm-1 control-label">발행일</label>

                                <div class="col-sm-11">
                                    <input type="text" name="published" class="form-control"
                                           value="<?php echo $item->published ?>"
                                           id="published" placeholder="2015-08-08">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-1 control-label">제목</label>

                                <div class="col-sm-11">
                                    <input type="text" name="title" class="form-control"
                                           value="<?php echo $item->title ?>"
                                           id="title" placeholder="제목을 입력하세요">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">대략적 내용</label>

                                <div class="col-sm-11">
                                    <textarea name="summary" id="summary"
                                              class="form-control" rows="3" placeholder="이 기사는 대충 이런 내용입니다..."><?php echo $item->summary ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-1 control-label">URL</label>

                                <div class="col-sm-11">
                                    <input type="text" name="url" class="form-control"
                                           value="<?php echo $item->url ?>"
                                           id="url" placeholder="http://example.com">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" id="gq-submit" class="btn btn-primary pull-right">추가하기</button>
                            <a href="<?= site_url('/report/index') ?>" class="btn btn-default pull-right"
                               style="margin-right: 10px;">뒤로가기</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>