<?php	if (isset($_POST['item_id'])) {		if (preg_match("/[0-9]\$/", $_POST['item_id'])) {			$item_id = $_POST['item_id'];		} else { $item_id = '0'; }	} else { $item_id = '0'; }		if (isset($_GET['guid'])) {		if (preg_match("/[0-9]\$/", $_GET['guid'])) {			$char_guid = $_GET['guid'];		} else { $char_guid = '0'; }	} else { $char_guid = '0'; }		if ($realm_num == 2) { $lk_donate_page = "<script type=\"text/javascript\">location.replace(\"./?page=lk&realm=$realm_num&do=buy\");</script>"; }		if ($user_logined[$realm_num] == "1") {		if (isset($_POST['submit'])) {			if ($char_guid > 0) {				if (getItemExist($item_id, $realm_num) > 0) {					$cost = getItemCost($item_id, $realm_num);						if ($cost > 0) {							$bonus_count = getAccountBonuses(getLoginFromId($user_guid[$realm_num], $realm_num));							if ($bonus_count >= $cost ) {								if (getCharAccountByGuid($char_guid, $realm_num) == $user_guid[$realm_num]) {									if (getCharOnlineByGuid($char_guid, $realm_num) == 0) {										if (setAccountBonuses(getLoginFromId($user_guid[$realm_num], $realm_num), $cost, '1') == 1) {											if (sendMail($guid, '������� $project_name', "���������� ��� �� ������� \"".getItemName($item_id, $realm_num)."\"\! ��� ���������� �������� ������ �� ������ �� � ���������� �������� �������\. ������� ��� �� � ����\, �������� ����\!", $item_id, 0, $realm_num) == 1) {												$lk_donate_page = 													"														<br>														<center>".@$str[$lang]['147'].". ".@$str[$lang]['114']."<script type=\"text/javascript\">setTimeout('location.replace(\"./?page=lk&do=main\")', 5000);</script>														<br>													";											} else {												setAccountBonuses(getLoginFromId($user_guid[$realm_num], $realm_num), $cost, '2');												$lk_donate_page = 													"														<br>														<center>".@$str[$lang]['146'].". ".@$str[$lang]['114']."<script type=\"text/javascript\">setTimeout('location.replace(\"./?page=lk&realm=$realm_num&do=buyitem\")', 5000);</script>														<br>													";											}										} else {											$lk_donate_page = 												"													<br>													<center>".@$str[$lang]['145'].". ".@$str[$lang]['114']."<script type=\"text/javascript\">setTimeout('location.replace(\"./?page=lk&realm=$realm_num&do=buyitem\")', 5000);</script>													<br>												";										}									} else {										$lk_donate_page = 											"												<br>												<center>".@$str[$lang]['144'].". ".@$str[$lang]['114']."<script type=\"text/javascript\">setTimeout('location.replace(\"./?page=lk&realm=$realm_num&do=buyitem\")', 5000);</script>												<br>											";									}								} else {									$lk_donate_page = 										"											<br>											<center>".@$str[$lang]['143'].". ".@$str[$lang]['114']."<script type=\"text/javascript\">setTimeout('location.replace(\"./?page=lk&realm=$realm_num&do=buyitem\")', 5000);</script>											<br>										";								}							} else {								$lk_donate_page = 									"										<br>										<center>".@$str[$lang]['142'].". ".@$str[$lang]['114']."<script type=\"text/javascript\">setTimeout('location.replace(\"./?page=lk&realm=$realm_num&do=buyitem\")', 5000);</script>										<br>									";							}						} else {							$lk_donate_page = 								"									<br>									<center>".@$str[$lang]['136'].". ".@$str[$lang]['114']."<script type=\"text/javascript\">setTimeout('location.replace(\"./?page=lk&realm=$realm_num&do=buyitem\")', 5000);</script>									<br>								";						}				} else {					$lk_donate_page = 						"							<br>							<center>".@$str[$lang]['135'].". ".@$str[$lang]['114']."<script type=\"text/javascript\">setTimeout('location.replace(\"./?page=lk&realm=$realm_num&do=buyitem\")', 5000);</script>							<br>						";				}			} else {				if (getItemExist($item_id, $realm_num) > 0) {					$cost = getItemCost($item_id, $realm_num);					if ($cost > 0) {						$lk_donate_page = 							"								<br>								<center>									".@$str[$lang]['139']." - <a href=\"http://ru.wowhead.com/item=$item_id\" onmouseover=\"Tip('��������...', WIDTH, 330, OFFSETX, 10, OFFSETY, 25, STICKY, false); showContent('./modules/armory/view_item.php?realm=$realm_num&type=1&item=$item_id', 'ttcontent');\" target=\"_blank\">".getItemName($item_id, $realm_num)."</a><br>									".@$str[$lang]['140']." - <b>".$cost."</b> ".@$str[$lang]['141']."<br><br>							";						$user_characters_db = @mysql_query("SELECT name, guid, level FROM `".$mysql_db_characters[$realm_num]."`.`characters` WHERE account ='".$user_guid[$realm_num]."'", $ConnectDB[$realm_num]);						if (@mysql_num_rows($user_characters_db) > 0) {							while($result = mysql_fetch_array($user_characters_db)){									$lk_donate_page .= 										"											<form action=\"./?page=lk&realm=$realm_num&do=buyitem&guid=".$result['guid']."\" method=\"post\">												<input type=\"hidden\" value=\"$item_id\" name=\"item_id\">												<input type=\"submit\" class=\"input_button\" value=\"".@$str[$lang]['138']." ".$result['name']." (".$result['level'].")\" name=\"submit\">											</form>										";							}						} else {							$lk_donate_page .= 										"											".@$str[$lang]['137']."<br><br>										";						}						$lk_donate_page .= 							"								</center>							";					} else {						$lk_donate_page = 							"								<br>								<center>".@$str[$lang]['136'].". ".@$str[$lang]['114']."<script type=\"text/javascript\">setTimeout('location.replace(\"./?page=lk&realm=$realm_num&do=buyitem\")', 5000);</script>								<br>							";					}				} else {					$lk_donate_page = 						"							<br>							<center>".@$str[$lang]['135'].". ".@$str[$lang]['114']."<script type=\"text/javascript\">setTimeout('location.replace(\"./?page=lk&realm=$realm_num&do=buyitem\")', 5000);</script>							<br>						";				}			}		} else {			$lk_donate_page =				"					<center>						<form action=\"?page=lk&realm=$realm_num&do=buyitem\" method=\"post\">							".@$str[$lang]['133'].": <br><br><input type=\"text\" class=\"input_textbox\" name=\"item_id\"><br><br>							<input type=\"submit\" class=\"input_button\" value=\"".@$str[$lang]['134']."\" name=\"submit\">						</form>					</center>				";		}	} else { $lk_donate_page = "<script type=\"text/javascript\">location.replace(\"./?page=lk&realm=$realm_num\");</script>"; }?><div class="mb_top"><?php echo @$str[$lang]['132'];?> <?php echo $realm_title[$realm_num];?></div><div class="mb_main">	<?php echo $lk_donate_page;?></div><div class="mb_down"></div>