<div class="content-wrapper">
    <section class="content-header">
        <h1>
            회원 분류 추가하기
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form class="form-horizontal" action="<?= site_url('/core/submit_category') ?>"
                          method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="label" class="col-sm-1 control-label">분류</label>

                                <div class="col-sm-11">
                                    <input type="text" name="label" class="form-control"
                                           id="label" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" id="gq-submit" class="btn btn-primary pull-right">추가하기</button>
                            <a href="<?= site_url('/core/index') ?>" class="btn btn-default pull-right"
                               style="margin-right: 10px;">뒤로가기</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>