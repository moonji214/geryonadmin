<!-- //container -->
<div> ㅌ테스터 </div>
<div id="container" class="main">
	<!-- section1 -->
	<?php 
	$n = 0;
	$banner_arr1 = array();
	$banner_qry1 = "select * from banner where brand='".brid."' and (flag='W' or flag='D') and view='Y' and (pc_img!='' or m_img!='') and url!='' and location='占쎄맒占쎈뼊' order by ord desc";
	$banner_chk1_ = $db->query($banner_qry1);
	while($banner_chk1 = $db->fetch($banner_chk1_)) {
		if(!empty($banner_chk1) && ($banner_chk1['nodate'] == "Y" || ($banner_chk1['nodate'] == "N" && $banner_chk1['sdate'] <= date("Y-m-d H:i:s") && $banner_chk1['edate'] >= date("Y-m-d H:i:s")))) { 
			$img_chk = (!empty($banner_chk1['pc_img'])) ? $banner_chk1['pc_img'] : $banner_chk1['m_img'];
			$banner_arr1[$n]['img'] = $img_chk;
			$banner_arr1[$n]['alt'] = $banner_chk1['alt'];
			$banner_arr1[$n]['url'] = $banner_chk1['url'];
			$banner_arr1[$n]['num'] = $banner_chk1['num'];
			$n++;
		}
	}
	if(count($banner_arr1) > 0) { ?>
	<div class="section1">
			   
		<div class="main_banner swiper-container">
			<div class="swiper-wrapper">

				<?php for($i=0; $i<count($banner_arr1); $i++) { ?>
				<div class="swiper-slide" style="background-image:url('<?php echo base_file.$banner_arr1[$i]['img']; ?>');" onclick="location.href='<?php echo $banner_arr1[$i]['url']; ?>';a.bbs('banner', '<?php echo $banner_arr1[$i]['num']; ?>');"></div>
				<?php } ?>
			</div>
			<div class="pagination"></div>
		</div>

	</div>
	<?php } ?>
	<!-- //section1 -->
	
	<!-- section2 -->
	<div class="section2">
	   <div class="cont">
			<h2><img src="<?php echo base_url; ?>inc/images/main_se2_title.png" alt="/."></h2>                    
			<div class="list">
				<dl>
					<dt class="title_box"><span>주식시황</strong></span><a href="<?php echo base_url; ?>board/?p=<?php echo $util->XOREncode('investment'); ?>" class="btn_more">占쎌쁽�뙴占� 占쎈쐭癰귣떯由� <em>+</em></a></dt>
					<dd>
					   <ul class="se2_data_list">
							<?php 
							$board_qry1 = $db->query("select * from ".$reference_table." where (mimg1!='' or pcimg1!='') order by bdate desc limit 3");
							while($board_chk1 = $db->fetch($board_qry1)) {
								$img_chk = (!empty($board_chk1['pcimg1'])) ? $board_chk1['pcimg1'] : $board_chk1['mimg1'];
								echo "<li><a href=\"".base_url."board/?p=".$util->XOREncode('investment_detail')."&bn=".$util->XOREncode($board_chk1['num'])."\"><img src=\"".base_file.$img_chk."\" alt=\"board\"></a></li>";
							}
							?>
					   </ul>
					</dd>
				</dl>
			</div>
			<a href="<?php echo base_url; ?>board/?p=<?php echo $util->XOREncode('investment'); ?>" class="btn2">배너</a>
			<div class="banner">
				<?php
				$banner_chk2 = $db->queryfetch("select * from banner where brand='".brid."' and (flag='W' or flag='D') and view='Y' and (pc_img!='' or m_img!='') and url!='' and location='餓λ쵐釉�' order by ord desc limit 1");
				if(!empty($banner_chk2) && ($banner_chk2['nodate'] == "Y" || ($banner_chk2['nodate'] == "N" && $banner_chk2['sdate'] <= date("Y-m-d H:i:s") && $banner_chk2['edate'] >= date("Y-m-d H:i:s")))) { 
				$img_chk = (!empty($banner_chk2['pc_img'])) ? $banner_chk2['pc_img'] : $banner_chk2['m_img'];	
				?>
				<a href="<?php echo $banner_chk2['url']; ?>" onclick="a.bbs('banner', '<?php echo $banner_chk2['num']; ?>');" target="<?php echo $banner_chk2['target']; ?>"><img src="<?php echo base_file.$img_chk; ?>" alt="<?php echo $banner_chk2['alt']; ?>"></a>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- //section2 -->

	<!-- section3 -->
	<div class="section3">
	   <div class="cont">
			<div class="list">
				<dl>
					<dt class="title_box"><span>상품소개</strong></span><a href="<?php echo base_url; ?>item/?p=<?php echo $util->XOREncode('service'); ?>" class="btn_more">占쎌읈筌ｏ옙 占쎄퐣�뜮袁⑸뮞 占쎌뵠占쎈짗 <em>+</em></a></dt>
					<dd>
					   <ul>

							<?php
							$it=1;
							$item_qry = $db->query("select * from item where brand='".brid."' and view='Y' and sell_price > 0 and pcimg1!='' order by ord desc");
							while($item = $db->fetch($item_qry)) {
								
								if(mb_strpos($item['name'], "연장") !== false) {
									$keyword_chk = "<span>1개월 연장권</span> ";
								} else if(mb_strpos($item['name'], "최초") !== false) {
									$keyword_chk = "<span>최초이용권</span> <span>1개월</span> <span>이용권</span>";
								} else if(mb_strpos($item['name'], "플러스상품") !== false) {
									$keyword_chk = "<span>플러스상품</span> ";
								} else if(mb_strpos($item['name'], "영구") !== false) {
									$keyword_chk = "<span>영구이용원</span>";
								} else if(mb_strpos($item['name'], "기타") !== false) { 
									$keyword_chk = "<span>샘플상품</span>";
								} else {
									$keyword_chk ="";
								}


								echo "
								<li>
								   <a href=\"".base_url."item/?p=".$util->XOREncode('item')."&bn=".$util->XOREncode($item['num'])."\">
										<p class=\"img\"><img src=\"".base_file.$item['pcimg1']."\" alt=\"".$item['name']."\"></p>
										<div class=\"text_box\">
											<strong>".$item['discription']."</strong>
											<p>".$item['content']."</p>
											<div class=\"keyword\">".$keyword_chk."</div>
										</div>
								   </a>
								</li>
								";
								$it++;
							}
							?>
					   </ul>
					</dd>
				</dl>
				<a href="<?php echo base_url; ?>item/?p=<?php echo $util->XOREncode('payment'); ?>" class="btn2 btn_gray">결제하기</a>
			</div>
		</div>
	</div>
	<!-- //section3 -->
	
	<!-- section4 -->
	<div class="section4">
	   <div class="cont">
			<div class="list">
				<dl>
					<dt class="title_box"><span>수익후기 <strong>수익</strong></span><a href="<?php echo base_url; ?>board/?p=<?php echo $util->XOREncode('review'); ?>" class="btn_more">더보기<em>+</em></a></dt>
					<dd>
					  <a href="" class="btn_prev"><span class="hidden">prev</span></a>
					  <a href="" class="btn_next"><span class="hidden">next</span></a>

					  <div class="main_banner2 swiper-container">
						   <ul class="swiper-wrapper">

								<?php 
								$board_qry2 = $db->query("select * from ".$review_table." where options like '%수익%' order by bdate desc, wdate desc limit 12");
								while($board_chk2 = $db->fetch($board_qry2)) {
									
									$pname = (!empty($board_chk2['etc_txt'])) ? $board_chk2['etc_txt'] : "기타후기";
									
									if(!empty($board_chk2['etc_op'])) {
										$etc_op_ = explode("|", $board_chk2['etc_op']);
										$etc_op = "<span class=\"product ".$etc_op_[0]."\">".$etc_op_[1]."</span>";
									} else {
										$etc_op = "<span class=\"product etc\">상품</span>";
									}

									$etc_op = ""; // 

									if(!empty($board_chk2['revenue']) && $board_chk2['revenue'] != 0) {
										$revenue = "<span class=\"percent\">+".@round($board_chk2['revenue'])."%</span>";
									} else {
										$revenue = "";
									}
									
									if(!empty($board_chk2['pcimg1'])) {
										$review_img = base_file.$board_chk2['pcimg1'];
									} else if(!empty($board_chk2['mimg1'])) {
										$review_img = base_file.$board_chk2['mimg1'];
									} else {
										$review_img = base_url."m/inc/images/review_noimg.png";
									}

									echo "
									<li class=\"swiper-slide\">
									   <a href=\"".base_url."board/?p=".$util->XOREncode('review_detail')."&bn=".$util->XOREncode($board_chk2['num'])."\" class=\"ani1\">
											<div class=\"review_box1\">
											  <dl>
												<dt><img src=\"".$review_img."\" alt=\"board\"></dt>
												<dd>
													<em class=\"text_line1\">".$pname."</em>
													".$etc_op.$revenue."
												</dd>
												<dd class=\"text text_line2\">
													".$board_chk2['subject']."
												</dd>
												<dd>
													<span class=\"star star".$board_chk2['star']."\"></span>
												</dd>
												<dd>
													<span class=\"date\">".str_replace("-", ".", $board_chk2['bdate'])."</span>
												</dd>
											  </dl>
										  </div>
									   </a>
									</li>									
									";
								}
								?>
						   </ul>
						</div>
					</dd>
				</dl>
				
			</div>
		</div>
	</div>
	<!-- //section4 -->
	
	<!-- section5 -->
	<div class="section5">
	   <div class="cont">
			<div class="list">
				<dl>
					<dt class="title_box"><span>공지사항 <strong>고객센터</strong></span><a href="<?php echo base_url; ?>board/?p=<?php echo $util->XOREncode('notice'); ?>" class="btn_more">더보기 <em>+</em></a></dt>
					<dd>
						<ul>
							<?php 
							$board_qry3 = $db->query("select num, subject, bdate from ".$notice_table." order by options='공지' desc, bdate desc, wdate desc limit 3");
							while($board_chk3 = $db->fetch($board_qry3)) {
								echo "
								<li>
									<a href=\"".base_url."board/?p=".$util->XOREncode('notice_detail')."&bn=".$util->XOREncode($board_chk3['num'])."\">
										<div class=\"text_line1\">".$board_chk3['subject']."</div>
										<span class=\"date\">".str_replace("-", ".", $board_chk3['bdate'])."</span>
									</a>
								</li>";
							}
							?>
						</ul>
					</dd>
				</dl>
				
				<?php
				$banner_chk3 = $db->queryfetch("select * from banner where brand='".brid."' and (flag='W' or flag='D') and view='Y' and (pc_img!='' or m_img!='') and url!='' and location='서울' order by ord desc limit 1");
				if(!empty($banner_chk3) && ($banner_chk3['nodate'] == "Y" || ($banner_chk3['nodate'] == "N" && $banner_chk3['sdate'] <= date("Y-m-d H:i:s") && $banner_chk3['edate'] >= date("Y-m-d H:i:s")))) { 
				$img_chk = (!empty($banner_chk3['pc_img'])) ? $banner_chk3['pc_img'] : $banner_chk3['m_img'];	
				?>
				<a href="<?php echo $banner_chk3['url']; ?>" onclick="a.bbs('banner', '<?php echo $banner_chk3['num']; ?>');" target="<?php echo $banner_chk3['target']; ?>" class="banner"><img src="<?php echo base_file.$img_chk; ?>" alt="<?php echo $banner_chk3['alt']; ?>"></a>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- //section5 -->
	
</div>
<!-- //container -->

<!-- main_pop   -->
<?php 
$popup_chk = $db->queryfetch("select * from popup where brand='".brid."' and flag='W' and view='Y' and img!='' and url!='' order by ord desc limit 1");
if(!empty($popup_chk) && ($popup_chk['nodate'] == "Y" || ($popup_chk['nodate'] == "N" && $popup_chk['sdate'] <= date("Y-m-d H:i:s") && $popup_chk['edate'] >= date("Y-m-d H:i:s")))) { ?>
<div id="main_pop" class="pops">
	<div class="bg"></div>
	<div class="popup_box">
		<p class="img"><a href="<?php echo $popup_chk['url']; ?>" target="<?php echo $popup_chk['target']; ?>" onclick="a.bbs('popup', '<?php echo $popup_chk['num']; ?>');"><img src="<?php echo base_file.$popup_chk['img']; ?>" alt="<?php echo $popup_chk['alt']; ?>"></a></p>
		<ul>
			<li><input type="checkbox" id="layer_chk1" checked><label for="layer_chk1"></label><a href="" class="btn_today_close">굿</a></li>
			<li><a href="" class="btn_today_close1">닫기</a></li>
		</ul>
	</div>
</div>
<?php } ?>
<!-- //main_pop  -->
