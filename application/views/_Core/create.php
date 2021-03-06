<div class="content-wrapper">
    <section class="content-header">
        <h1>
            GOQUAL 글쓰기
            <small>이쁘게 써주세요 회사 이미지가 달렸습니다.</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form class="form-horizontal" action="<?= site_url('/core/submit') ?>" method="post" id="frm">
                        <input type="hidden" name="dirkeycode" id="dirkeycode" value="core">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-1 control-label">제목</label>

                                <div class="col-sm-11">
                                    <input type="text" name="title" class="form-control"
                                           value="<?php if ($data != null) echo $data->title ?>"
                                           id="title" placeholder="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-1 control-label">분류</label>
                                <div class="col-sm-11">
                                    <select class="form-control select2" name="category"
                                            value="<?php if($data != null) echo $data->for_categoryid ?>">
                                        <?php
                                        foreach($categories as $item) {
                                            ?>
                                            <option value="<?php echo $item->_categoryid ?>"><?php echo $item->label ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">간단한 설명</label>

                                <div class="col-sm-11">
                                    <input type="text" name="summary" class="form-control"
                                           value="<?php if ($data) echo $data->summary ?>"
                                           id="summary" placeholder="summary">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-1 control-label">내용</label>

                                <div class="col-sm-11">
                                     <textarea class="form-control"
                                               style="height: 400px; width:100%;"
                                               value="<?php if ($data) echo $data->content ?>"
                                               name="content" id="smarteditor"
                                               rows="10" cols="200"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" id="ng-submit" class="btn btn-primary pull-right">글쓰기</button>
                            <a href="<?= site_url('/core/index') ?>" class="btn btn-default pull-right"
                               style="margin-right: 10px;">뒤로가기</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>