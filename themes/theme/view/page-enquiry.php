<?php
/**
 * view data
 *
 * @var $site
 * @var $seo
 * @var $page
 */

use Site\Models\FormField; ?>

<?php
$this->layout('layouts/main');
$fieldModel = new FormField();
$fields = $fieldModel->findAll("form_id=:form_id", ['form_id' => 7], 'sort');
$fieldsKeys = [];
foreach ($fields as $field) {
    $fieldsKeys[$field['name']] = [
            'label' => $field['label'],
            'placeholder' => $field['placeholder'],
    ];
}
?>

<?php $this->push('custom_header') ?>
    <link rel="stylesheet" href="<?= themePath() ?>/css/style.css">
    <script type="text/javascript" src="<?= themePath() ?>/js/iconfont.js"></script>
<?php $this->end() ?>

    <main class="site-main" role="main">
        <div class="pj_container" data-barba="wrapper">
            <div class="b_container" data-barba="container" data-barba-namespace="index">
                <div id="page_index" class="page_container">
                    <section id="kv" class="sp_h i_obs">
                        <div class="inner page-inner">
                            <div class="container-xl">
                                <h1 class="big-t _pg_ov_up">
								<span class="fs100">
									<i class="big-t animated fadeInUp">E</i>
									<i class="big-t animated fadeInUp">n</i>
									<i class="big-t animated fadeInUp">q</i>
									<i class="big-t animated fadeInUp">u</i>
									<i class="big-t animated fadeInUp">i</i>
									<i class="big-t animated fadeInUp">r</i>
									<i class="big-t animated fadeInUp">y</i>
								</span>
                                </h1>

                                <div class="fs100 _pg_ov_up remo_tt_cn remo-tt-inner">
                                    <div class="animated fadeInUp">預</div>
                                    <div class="animated fadeInUp">約</div>
                                    <div class="animated fadeInUp">報</div>
                                    <div class="animated fadeInUp">價</div>
                                </div>

                            </div>
                        </div>
                        <div class="v">
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><div class="_pg_scales"><img src="<?= themePath() ?>/images/b1.png"></div></div>
                                </div>
                            </div>
                        </div>
                        <div class="ph ovh bart"><span class="plx plx_scale"><img src="<?= themePath() ?>/images/xt_1.png" alt="" class="visible-lg"><img src="<?= themePath() ?>/images/xt_1.png" alt="" class="visible-sm"></span></div>
                    </section>
                    <div class="content_inner">
                        <section id="Enquiry">
                            <div class="ph ovh bars"><span class="plx plx_scale" data-plx-scale="1.15" data-plx-duration="1.5"><img src="<?= themePath() ?>/images/bars_1.png" alt=""></span></div>
                            <div class="probar">
                                <div class="bar active">
                                    <div class="bar-radiua">
                                        <div class="number fs80">01</div>
                                        <p><?= t('renovation info') ?></p>
                                    </div>
                                </div>
                                <div class="bar ">
                                    <div class="bar-radiua">
                                        <div class="number fs80">02</div>
                                        <p><?= t('design policy') ?></p>
                                    </div>
                                </div>
                                <div class="bar">
                                    <div class="bar-radiua">
                                        <div class="number fs80">03</div>
                                        <p><?= t('contact info') ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="container-xl">
                                <div class="backs">
                                    <div class="contents" id="basicInfo">
                                        <div class="t fs36 mt-5  bold white text-center"><p class="new_title"><?= t('renovation info') ?></p></div>
                                        <div class="content mt-5 mb-5">
                                            <form role="form" class="row" onsubmit=" return false " novalidate="">
                                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                    <label for="wyzk"><i class="f-icos"><img src="<?= themePath() ?>/images/ii1.png"></i><span><?= $fieldsKeys['wyzk']['label'];?></span></label>
                                                    <div class="radioboxlist mt-4">
                                                        <label class="radiobox-inline fs14">
                                                            <div class="radiobox"><input type="radio" name="wyzk" id="optionsRadios1" value="<?= t('occupied refurb') ?>" checked=""><span class="radiomark"><?= t('occupied refurb') ?></span></div>
                                                        </label>
                                                        <label class="radiobox-inline fs14">
                                                            <div class="radiobox"><input type="radio" name="wyzk" id="optionsRadios2" value="<?= t('received') ?>"><span class="radiomark"><?= t('received') ?></span></div>
                                                        </label>
                                                        <label class="radiobox-inline fs14">
                                                            <div class="radiobox"><input type="radio" name="wyzk" id="optionsRadios3" value="<?= t('no receive') ?>"><span class="radiomark"><?= t('no receive') ?></span></div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                    <label for="dwzl"><i class="f-icos"><img src="<?= themePath() ?>/images/ii2.png"></i><span><?= $fieldsKeys['dwzl']['label'];?></span></label>
                                                    <div class="relative mt-4">
                                                        <select name="dwzl" class="form-control fs14">
                                                            <option value=""><?= t('please select') ?></option>
                                                            <option value="<?= t('private property') ?> "><?= t('private property') ?></option>
                                                            <option value="<?= t('house village') ?>"><?= t('house village') ?></option>
                                                            <option value="<?= t('hko public housing') ?>"><?= t('hko public housing') ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                    <label for="addr"><i class="f-icos"><img src="<?= themePath() ?>/images/ii3.png"></i><span><?= $fieldsKeys['address']['label'];?>*</span></label>
                                                    <input type="text" class="form-control fs14 mt-4" name="address" id="address" placeholder="<?= $fieldsKeys['address']['placeholder'];?>">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                    <label for="ft2"><i class="f-icos"><img src="<?= themePath() ?>/images/ii4.png"></i><span><?= $fieldsKeys['ft2']['label'];?>*</span></label>
                                                    <input type="text" class="form-control fs14 mt-4" name="ft2" id="pfc" placeholder="<?= $fieldsKeys['ft2']['placeholder'];?>">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                    <label for="hkd"><i class="f-icos"><img src="<?= themePath() ?>/images/ii5.png"></i><span><?= $fieldsKeys['hkd']['label'];?>*</span></label>
                                                    <input type="text" class="form-control fs14 mt-4" name="hkd" id="hkd" placeholder="<?= $fieldsKeys['hkd']['placeholder'];?>">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                    <label for="people"><i class="f-icos"><img src="<?= themePath() ?>/images/ii6.png"></i><span><?= $fieldsKeys['people']['label'];?></span></label>
                                                    <input type="text" class="form-control fs14 mt-4" name="people" id="people" placeholder="<?= $fieldsKeys['people']['placeholder'];?>">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                    <label for="num"><i class="f-icos"><img src="<?= themePath() ?>/images/ii7.png"></i><span><?= $fieldsKeys['num']['label'];?></span></label>
                                                    <input type="text" class="form-control mt-4 fs14" name="num" id="num" placeholder="<?= $fieldsKeys['num']['placeholder'];?>">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                    <label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ii8.png"></i><span><?= $fieldsKeys['date']['label'];?></span></label>
                                                    <div class="pos">
                                                        <input type="text" class="form-control mt-4 fs14" id="date" name="date" oninvalid="setCustomValidity(<?= $fieldsKeys['date'];?>);" oninput="setCustomValidity('');" placeholder="YY-MM-DD" lay-key="1">
                                                        <i class="fa fa-calendar dateimg" lay-key="1"></i>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="contents main-hide" id="education">
                                        <div class="t fs36 mt-5  bold white text-center"><p id="test2" class="new_title"><?= t('design policy') ?></p></div>
                                        <div class="content mt-5 mb-5">
                                            <form role="form" class="row" onsubmit=" return false " novalidate="">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="tablist">
                                                        <div class="form-group">
                                                            <label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ii10.png"></i><span><?= $fieldsKeys['fg']['label'];?></span></label>
                                                            <div class="radioboxlist radioboxlist2 mt-4">
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios1" value="<?= t('industrial style') ?>" checked=""><span class="radiomark"><?= t('industrial style') ?></span></div>
                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios2" value="
<?= t('muji style') ?>"><span class="radiomark">
<?= t('muji style') ?></span></div>
                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios3" value="
<?= t('light luxury') ?>"><span class="radiomark">
<?= t('light luxury') ?></span></div>
                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios4" value="
<?= t('japanese style') ?>"><span class="radiomark">
<?= t('japanese style') ?></span></div>
                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios5" value="
<?= t('nordic style') ?>"><span class="radiomark">
<?= t('nordic style') ?></span></div>
                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios6" value="
<?= t('minimalist style') ?>"><span class="radiomark">
<?= t('minimalist style') ?></span></div>
                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios7" value="
<?= t('fashion style') ?>"><span class="radiomark">
<?= t('fashion style') ?></span></div>
                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios8" value="
<?= t('greek style') ?>"><span class="radiomark">
<?= t('greek style') ?></span></div>
                                                                </label>
                                                                <input type="text" class="form-control fs14 mt-4" name="fg_other" id="fg_other" placeholder="<?= $fieldsKeys['fg_other']['placeholder'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ii11.png"></i><span><?= $fieldsKeys['color']['label'];?></span></label>
                                                            <div class="radioboxlist radioboxlist2 mt-4">
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios11" value="<?= t('black') ?>" checked=""><span class="radiomark"><?= t('black') ?></span></div>

                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios22" value="
<?= t('white') ?>"><span class="radiomark">
<?= t('white') ?></span></div>

                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios33" value="
<?= t('wood') ?>"><span class="radiomark">
<?= t('wood') ?></span></div>

                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios44" value="
<?= t('gray') ?>"><span class="radiomark">
<?= t('gray') ?></span></div>

                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios55" value="
<?= t('blue') ?>"><span class="radiomark">
<?= t('blue') ?></span></div>

                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios66" value="
<?= t('beige') ?>"><span class="radiomark">
<?= t('beige') ?></span></div>

                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios77" value="
<?= t('brown') ?>"><span class="radiomark">
<?= t('brown') ?></span></div>

                                                                </label>
                                                                <label class="radiobox-inline fs14">
                                                                    <div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios88" value="
<?= t('pink') ?>"><span class="radiomark">
<?= t('pink') ?></span></div>

                                                                </label>
                                                                <input type="text" class="form-control fs14 mt-4" name="color_other" id="color_other" placeholder="<?= $fieldsKeys['color_other']['placeholder'];?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <input type="hidden" id="sszfg" name="sszfg" value="<?= t('design priority') ?>">
                                                    <div class="tablpal t_szfg">
                                                        <div class="items active">
                                                            <div class="imgs">
                                                                <img src="<?= themePath() ?>/images/icon1-2.png" class="ic">
                                                                <img src="<?= themePath() ?>/images/f1.png" class="ich">
                                                            </div>
                                                            <h3 class="fs24"><?= t('design priority') ?></h3>
                                                        </div>
                                                        <div class="items">
                                                            <div class="imgs">
                                                                <img src="<?= themePath() ?>/images/f2.png" class="ic">
                                                                <img src="<?= themePath() ?>/images/icon2-1.png" class="ich">
                                                            </div>
                                                            <h3 class="fs24"><?= t('cost priority') ?></h3>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="contents main-hide" id="miaomiao">
                                        <div class="t fs36 mt-5  bold white text-center"><p class="new_title"><?= t('contact info') ?></p></div>
                                        <div class="content mt-5 mb-5">
                                            <form role="form" class="row" onsubmit=" return false " novalidate="">
                                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                    <label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ci111.png"></i><span><?= $fieldsKeys['name']['label'];?>*</span></label>
                                                    <input type="text" class="form-control fs14 mt-4" name="name" id="name" placeholder="<?= $fieldsKeys['name']['placeholder'];?>">

                                                </div>
                                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                    <label for="call"><i class="f-icos"><img src="<?= themePath() ?>/images/ci1.png"></i><?= $fieldsKeys['call']['label'];?>*</label>
                                                    <div class="relative new_call mt-4">
                                                        <select id="call" name="call" class="form-control fs14">
                                                            <option value=""><?= t('please select') ?></option>
                                                            <option value="<?= t('mister') ?>"><?= t('mister') ?></option>
                                                            <option value="<?= t('mistress') ?>"><?= t('mistress') ?></option>
                                                            <option value="<?= t('miss') ?>"><?= t('miss') ?></option>
                                                            <option value="<?= t('ms') ?>"><?= t('ms') ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                    <label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ci2.png"></i><span><?= $fieldsKeys['email']['label'];?></span></label>
                                                    <input type="text" class="form-control fs14 mt-4" name="email" id="email" placeholder="<?= $fieldsKeys['email']['placeholder'];?>">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                    <label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ci4.png"></i><span><?= $fieldsKeys['phone']['label'];?>*</span></label>
                                                    <input type="text" class="form-control fs14 mt-4" name="phone" id="phone" placeholder="<?= $fieldsKeys['phone']['placeholder'];?>">
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ii4.png"></i><span><?= $fieldsKeys['tj']['label'];?></span></label>
                                                    <div class="radioboxlist radioboxlist3 mt-4">
                                                        <label class="radiobox-inline fs14">
                                                            <div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios1" value="Facebook" checked=""><span class="radiomark">Facebook</span></div>
                                                        </label>
                                                        <label class="radiobox-inline fs14">
                                                            <div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios2" value="Youtube"><span class="radiomark">Youtube</span></div>
                                                        </label>
                                                        <label class="radiobox-inline fs14">
                                                            <div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios3" value="<?= t('website search') ?>"><span class="radiomark"><?= t('website search') ?></span></div>
                                                        </label>
                                                        <label class="radiobox-inline fs14">
                                                            <div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios4" value="<?= t('friends intro') ?>"><span class="radiomark"><?= t('friends intro') ?></span></div>
                                                        </label>
                                                        <label class="radiobox-inline fs14">
                                                            <div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios5" value="<?= t('tv program') ?>"><span class="radiomark"><?= t('tv program') ?></span></div>
                                                        </label>
                                                        <label class="radiobox-inline fs14">
                                                            <div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios6" value="<?= t('leaflet') ?>"><span class="radiomark"><?= t('leaflet') ?></span></div>
                                                        </label>
                                                        <div class="border fs14">
                                                            <input type="text" class="form-control fs14" name="tj_other" style="border-bottom:none" id="tj_other" placeholder="<?= $fieldsKeys['tj_other']['placeholder'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/i12.png"></i><span><?= $fieldsKeys['other']['label'];?></span></label>
                                                    <textarea class="form-control" id="other" name="other" rows="8"></textarea>
                                                </div>

                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="d-flex align-items-center justify-content-center mt-5">

                                                        <a href="javascript:;" id="send2" class="send"><?= t('appointment quote') ?></a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="next_button" style="right:4rem;width: 29.5%;">
                                        <div class="d-flex align-items-center justify-content-around">
                                            <div class="col_btn white" id="previous_step" style="display: none;">
                                                <a href="javascript:;" class="icos" rel="noopener">
                                                    <svg class="icon" aria-hidden="true">
                                                        <use xlink:href="#icon-toleft"></use>
                                                    </svg>
                                                </a>
                                                <span><?= t('previous step') ?></span>
                                            </div>
                                            <div class="col_btn white" id="next_step">
                                                <a href="javascript:;" class="icos" rel="noopener">
                                                    <svg class="icon" aria-hidden="true">
                                                        <use xlink:href="#icon-toright"></use>
                                                    </svg>
                                                </a>
                                                <span><?= t('next step') ?></span>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </main>

<?php $this->push('custom_footer') ?>
    <script type="text/javascript" src="<?= themePath() ?>/vancutsem/js/imagesloaded.pkgd.min.js" id="images-loaded-js"></script>
    <script type="text/javascript" src="<?= themePath() ?>/vancutsem/js/aos.js" id="aos-js"></script>
    <script type="text/javascript" src="<?= themePath() ?>/laydate/laydate.js"></script>
    <script type="text/javascript" src="<?= themePath() ?>/js/script.js" id="main-script-js"></script>
<?php $this->end() ?>