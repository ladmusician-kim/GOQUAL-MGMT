<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            designer 글쓰기
            <small>이쁘게 써주세요 회사 이미지가 달렸습니다.</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form class="form-horizontal" action="<?= site_url('/designer/update_submit') ?>" method="post"
                          id="frm">
                        <input type="hidden" name="designerid" value='<?php if ($item) echo $item->_designerid ?>'>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-1 control-label">제목</label>

                                <div class="col-sm-11">
                                    <input type="text" name="title" class="form-control"
                                           value="<?php if ($item != null) echo $item->title ?>"
                                           id="title" placeholder="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">간단한 설명</label>

                                <div class="col-sm-11">
                                    <input type="text" name="summary" class="form-control"
                                           value="<?php if ($item) echo $item->summary ?>"
                                           id="summary" placeholder="summary">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">내용</label>

                                <div class="col-sm-11">
                                     <textarea class="form-control"
                                               style="height: 400px; width:100%;"
                                               name="content" id="smarteditor"
                                               rows="10" cols="200"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" id="ng-submit" class="btn btn-primary pull-right">수정하기</button>
                            <a href="<?= site_url('/designer/detail?designerid=' . $item->_designerid) ?>"
                               class="btn btn-default pull-right" style="margin-right: 10px;">뒤로가기</a>
                            <a href="<?= site_url('/designer/index') ?>" class="btn btn-default pull-right"
                               style="margin-right: 10px;">목록보기</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<input id="gq-content" type="hidden" value="<?php echo htmlspecialchars($item->content, ENT_QUOTES); ?>">