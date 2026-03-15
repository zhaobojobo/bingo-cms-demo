<?php
/**
 * view data
 *
 * @var $site
 * @var $seo
 * @var $page
 */ ?>

<?php
$this->layout('layouts/main');
?>

<?php $this->push('custom_header') ?>
<link rel="stylesheet" href="<?= themePath() ?>/css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= themePath() ?>/bootstrap/scss/bootstrap.css">
<link rel="stylesheet" href="<?= themePath() ?>/css/animate.min.css">
<link rel="stylesheet" href="<?= themePath() ?>/css/swiper-bundle.min.css">
<link rel="stylesheet" href="<?= themePath() ?>/css/smooth-scrollbar.css">
<link rel="stylesheet" href="<?= themePath() ?>/vancutsem/css/aos.css">
<link rel="stylesheet" href="<?= themePath() ?>/vancutsem/style.css">
<link rel="stylesheet" href="<?= themePath() ?>/css/style.css">
<script type="text/javascript" src="<?= themePath() ?>/js/iconfont.js"></script>
<script type="text/javascript" src="<?= themePath() ?>/bootstrap/dist/js/bootstrap.min.js"></script>

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
										<p>裝修資料</p>
									</div>
								</div>
								<div class="bar ">
									<div class="bar-radiua">
										<div class="number fs80">02</div>
										<p>設計方針</p>
									</div>
								</div>
								<div class="bar">
									<div class="bar-radiua">
										<div class="number fs80">03</div>
										<p>聯絡資料</p>
									</div>
								</div>
							</div>
							<div class="container-xl">
						     	<div class="backs">								
									<div class="contents" id="basicInfo"> 
												<div class="t fs36 mt-5  bold white text-center"><p class="new_title">裝修資料</p></div>
												<div class="content mt-5 mb-5">
													<form role="form" class="row" onsubmit=" return false " novalidate="">
														<div class="form-group col-md-4 col-sm-12 col-xs-12">
															<label for="wyzk"><i class="f-icos"><img src="<?= themePath() ?>/images/ii1.png"></i><span>物業狀況</span></label>
															<div class="radioboxlist mt-4">
																<label class="radiobox-inline fs14">
																	<div class="radiobox"><input type="radio" name="wyzk" id="optionsRadios1" value="現住翻新" checked=""><span class="radiomark">現住翻新</span></div>
																</label>
																<label class="radiobox-inline fs14">
																	<div class="radiobox"><input type="radio" name="wyzk" id="optionsRadios2" value="已收樓"><span class="radiomark">已收樓</span></div>
																</label>
																<label class="radiobox-inline fs14">
																	<div class="radiobox"><input type="radio" name="wyzk" id="optionsRadios3" value="未收樓"><span class="radiomark">未收樓</span></div>
																</label>
															</div>
														</div>
														<div class="form-group col-md-4 col-sm-12 col-xs-12">
															<label for="dwzl"><i class="f-icos"><img src="<?= themePath() ?>/images/ii2.png"></i><span>單位種類</span></label>
															<div class="relative mt-4">
																<select name="dwzl" class="form-control fs14">
																	<option value="">請選擇</option>
																	<option value="私人物業">私人物業</option>
																	<option value="獨立屋/村屋">獨立屋/村屋</option>
																	<option value="居屋/公屋">居屋/公屋</option>
																</select>
															</div>
														</div>
														<div class="form-group col-md-4 col-sm-12 col-xs-12">
															<label for="addr"><i class="f-icos"><img src="<?= themePath() ?>/images/ii3.png"></i><span>詳細單位地址*</span></label>
															<input type="text" class="form-control fs14 mt-4" name="address" id="addr" placeholder="單位地址">
														</div>
														<div class="form-group col-md-4 col-sm-12 col-xs-12">
															<label for="ft2"><i class="f-icos"><img src="<?= themePath() ?>/images/ii4.png"></i><span>單位面積*</span></label>
															<input type="text" class="form-control fs14 mt-4" name="ft2" id="pfc" placeholder="平方呎 ft2">
														</div>
														<div class="form-group col-md-4 col-sm-12 col-xs-12">
															<label for="hkd"><i class="f-icos"><img src="<?= themePath() ?>/images/ii5.png"></i><span>裝修預算*</span></label>
															<input type="text" class="form-control fs14 mt-4" name="hkd" id="hkd" placeholder="HKD">
														</div>
														<div class="form-group col-md-4 col-sm-12 col-xs-12">
															<label for="people"><i class="f-icos"><img src="<?= themePath() ?>/images/ii6.png"></i><span>入住人數</span></label>
															<input type="text" class="form-control fs14 mt-4" name="people" id="people" placeholder="人數">
														</div>
														<div class="form-group col-md-4 col-sm-12 col-xs-12">
															<label for="num"><i class="f-icos"><img src="<?= themePath() ?>/images/ii7.png"></i><span>房間數目</span></label>
															<input type="text" class="form-control mt-4 fs14" name="num" id="num" placeholder="房數">
														</div>
														<div class="form-group col-md-4 col-sm-12 col-xs-12">
															<label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ii8.png"></i><span>收樓日期</span></label>
															<div class="pos">
																<input type="text" class="form-control mt-4 fs14" id="date" name="date" oninvalid="setCustomValidity('收樓日期');" oninput="setCustomValidity('');" placeholder="YY-MM-DD" lay-key="1">
																<i class="fa fa-calendar dateimg" lay-key="1"></i>
															</div>
														</div>
													</form>
												</div>							
									</div>
									<div class="contents main-hide" id="education">
												<div class="t fs36 mt-5  bold white text-center"><p id="test2" class="new_title">設計方針</p></div>
												<div class="content mt-5 mb-5">
													<form role="form" class="row" onsubmit=" return false " novalidate="">
														<div class="col-md-6 col-sm-12 col-xs-12">
															<div class="tablist">	
																<div class="form-group">
																	<label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ii10.png"></i><span>偏好風格</span></label>
                                                                  																		<div class="radioboxlist radioboxlist2 mt-4">
                                                                      																			<label class="radiobox-inline fs14">
																			<div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios1" value="工業風" checked=""><span class="radiomark">工業風</span></div>
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
																			<div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios2" value="
無印風"><span class="radiomark">
無印風</span></div>
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
																			<div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios3" value="
輕奢風"><span class="radiomark">
輕奢風</span></div>
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
																			<div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios4" value="
日系風"><span class="radiomark">
日系風</span></div>
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
																			<div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios5" value="
北歐風"><span class="radiomark">
北歐風</span></div>
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
																			<div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios6" value="
簡約風"><span class="radiomark">
簡約風</span></div>
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
																			<div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios7" value="
時尚風"><span class="radiomark">
時尚風</span></div>
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
																			<div class="radiobox"><input type="checkbox" name="fg[]" id="optionsRadios8" value="
希臘風"><span class="radiomark">
希臘風</span></div>
																		</label>
																		<input type="text" class="form-control fs14 mt-4" name="fg_other" id="fg_other" placeholder="其他 (選填)">
																	</div>
																</div>
																<div class="form-group">
																	<label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ii11.png"></i><span>偏好顏色</span></label>
																	<div class="radioboxlist radioboxlist2 mt-4">
                                                                      																			<label class="radiobox-inline fs14">
                                                                          	<div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios11" value="黑色" checked=""><span class="radiomark">黑色</span></div>
																			
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
                                                                          	<div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios22" value="
白色"><span class="radiomark">
白色</span></div>
																			
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
                                                                          	<div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios33" value="
木色"><span class="radiomark">
木色</span></div>
																			
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
                                                                          	<div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios44" value="
灰色"><span class="radiomark">
灰色</span></div>
																			
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
                                                                          	<div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios55" value="
藍色"><span class="radiomark">
藍色</span></div>
																			
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
                                                                          	<div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios66" value="
米色"><span class="radiomark">
米色</span></div>
																			
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
                                                                          	<div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios77" value="
棕色"><span class="radiomark">
棕色</span></div>
																			
																		</label>
                                                                        																		<label class="radiobox-inline fs14">
                                                                          	<div class="radiobox"><input type="checkbox" name="color[]" id="optionsRadios88" value="
粉色"><span class="radiomark">
粉色</span></div>
																			
																		</label>
																		<input type="text" class="form-control fs14 mt-4" name="color_other" id="color_other" placeholder="其他 (選填)">
																	</div>
																</div>
															</div>
															
														</div>
										
														<div class="col-md-6 col-sm-12 col-xs-12">
                                                            <input type="hidden" id="sszfg" name="sszfg" value="設計風格優先">
															<div class="tablpal t_szfg">
																<div class="items active">
																	<div class="imgs">
																		<img src="<?= themePath() ?>/images/icon1-2.png" class="ic">
																		<img src="<?= themePath() ?>/images/f1.png" class="ich">
																	</div>
																	<h3 class="fs24">設計風格優先</h3>
																</div>
																<div class="items">
																	<div class="imgs">
																		<img src="<?= themePath() ?>/images/f2.png" class="ic">
																		<img src="<?= themePath() ?>/images/icon2-1.png" class="ich">
																	</div>
																	<h3 class="fs24">成本效益優先</h3>
																</div>
															</div> 

														</div>
													</form>
												</div>							
									</div>
									<div class="contents main-hide" id="miaomiao">
												<div class="t fs36 mt-5  bold white text-center"><p class="new_title">聯絡資料</p></div>
												<div class="content mt-5 mb-5">
													<form role="form" class="row" onsubmit=" return false " novalidate="">
														<div class="form-group col-md-6 col-sm-12 col-xs-12">
															<label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ci111.png"></i><span>姓名*</span></label>
															<input type="text" class="form-control fs14 mt-4" name="name" id="name" placeholder="姓名">
													
														</div>
														<div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                          <label for="call"><i class="f-icos"><img src="<?= themePath() ?>/images/ci1.png"></i>稱呼*</label>
                                                          <div class="relative new_call mt-4">
                                                              <select id="call" name="call" class="form-control fs14">
                                                                  <option value="">請選擇</option>
                                                                  <option value="先生">先生</option>
                                                                  <option value="太太">太太</option>
                                                                  <option value="小姐">小姐</option>
                                                                  <option value="女士">女士</option>
                                                              </select>
                                                          </div>
                                                      </div>
														<div class="form-group col-md-6 col-sm-12 col-xs-12">
															<label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ci2.png"></i><span>電郵地址</span></label>
															<input type="text" class="form-control fs14 mt-4" name="email" id="email" placeholder="電郵地址">
														</div>
														<div class="form-group col-md-6 col-sm-12 col-xs-12">
															<label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ci4.png"></i><span>聯絡電話*</span></label>
															<input type="text" class="form-control fs14 mt-4" name="phone" id="phone" placeholder="聯絡電話">
														</div>
														<div class="form-group col-md-12 col-sm-12 col-xs-12">
															<label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/ii4.png"></i><span>認識我們的途徑</span></label>
															<div class="radioboxlist radioboxlist3 mt-4">
																<label class="radiobox-inline fs14">
																	<div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios1" value="Facebook" checked=""><span class="radiomark">Facebook</span></div>
																</label>
																<label class="radiobox-inline fs14">
																	<div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios2" value="Youtube"><span class="radiomark">Youtube</span></div>
																</label>
																<label class="radiobox-inline fs14">
																	<div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios3" value="網站搜尋"><span class="radiomark">網站搜尋</span></div>
																</label>
																<label class="radiobox-inline fs14">
																	<div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios4" value="親友介紹"><span class="radiomark">親友介紹</span></div>
																</label>
																<label class="radiobox-inline fs14">
																	<div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios5" value="電視節目"><span class="radiomark">電視節目</span></div>
																</label>
																<label class="radiobox-inline fs14">
																	<div class="radiobox"><input type="checkbox" name="tj[]" id="optionsRadios6" value="宣傳單張"><span class="radiomark">宣傳單張</span></div>
																</label>
																<div class="border fs14">
																<input type="text" class="form-control fs14" name="tj_other" style="border-bottom:none" id="tj_other" placeholder="其他 (選填)">
																</div>
															</div>
														</div>
														<div class="form-group col-md-12 col-sm-12 col-xs-12">
															<label for="name"><i class="f-icos"><img src="<?= themePath() ?>/images/i12.png"></i><span>其他查詢</span></label>
															<textarea class="form-control" id="other" name="other" rows="8"></textarea>
														</div>
										
														<div class="col-md-12 col-sm-12 col-xs-12">
														<div class="d-flex align-items-center justify-content-center mt-5">

																<a href="javascript:;" id="send2" class="send">預約報價</a>
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
												<span>上一步</span>
											</div>
											<div class="col_btn white" id="next_step">
												<a href="javascript:;" class="icos" rel="noopener">
													<svg class="icon" aria-hidden="true">
														<use xlink:href="#icon-toright"></use>
													</svg>
												</a>
												<span>下一步</span>
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
<script type="text/javascript" src="<?= themePath() ?>/js/swiper-bundle.min.js"></script>
<script type="text/javascript" src="<?= themePath() ?>/vancutsem/js/aos.js" id="aos-js"></script>
<script type="text/javascript" src="<?= themePath() ?>/laydate/laydate.js"></script>
<script type="text/javascript" src="<?= themePath() ?>/js/script.js" id="main-script-js"></script>
<?php $this->end() ?>
