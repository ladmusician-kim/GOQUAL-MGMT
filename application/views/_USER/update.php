<div class="content-wrapper">
    <section class="content-header">
        <h1>
            회원추가하기
            <small>goqual 계정으로 가입해주세요.</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <input id="category_id" type="hidden" value="<?php echo $user->for_categoryid ?>">
                    <form class="form-horizontal" action="<?= site_url('/user/submit_update') ?>"
                          method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?php if($user != null) echo $user->_id ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="email" class="col-sm-1 control-label">이메일</label>

                                <div class="col-sm-11">
                                    <input type="text" name="email" class="form-control"
                                           value="<?php if($user != null) echo $user->email ?>"
                                           id="email" placeholder="test@goqual.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-1 control-label">비밀번호</label>

                                <div class="col-sm-11">
                                    <input type="password" name="password" class="form-control"
                                           id="password" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-1 control-label">분류</label>
                                <div class="col-sm-11">
                                    <select class="form-control select2" name="category"
                                            value="<?php if($user != null) echo $user->for_categoryid ?>">
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
                                <label for="password" class="col-sm-1 control-label">프로필 사진</label>
                                <div class="col-sm-11">
                                    <input type="file" name="profile">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" id="ng-submit" class="btn btn-primary pull-right">추가하기</button>
                            <a href="<?= site_url('/user/index') ?>" class="btn btn-default pull-right"
                               style="margin-right: 10px;">뒤로가기</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>