<?php
if(!isset($_COOKIE['pref']))
{
setcookie("pref","Homepage",time()+5184000);
	$cookieFound = false;
}else{ 
	$cookieFound = true; 
}
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<?php
include("language.php");
include("classes.php");
include("startup.php");
?>
<title><?php echo $title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Ivan Golović - izrada web stranica i Windows aplikacija" />
<meta name="keywords" content="golović,golovic,golovich,golowich,ivan,web,dizajn,design,web stranice,programiranje,software,development,windows,desktop,aplikacije" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="res/a.ico" />
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAcoP7jn4fUgLDrbNcQylvxRQHlnWEod3LiaQcc2SPIB0K6C1O2RSZCwU9S_WrIRyDnAzfS8aErupuKA" type="text/javascript"></script>
<script type="text/javascript" src="js/transition_vertical.js"></script>
<script type="text/javascript" src="js/menu_item_click_handler.js"></script>
<script type="text/javascript" src="js/link_tooltip.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/gallery.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/site_poll.js"></script>
<script type="text/javascript" src="js/slide_div.js"></script>
<script type="text/javascript" src="js/timer.js"></script>
<meta name="author" content="www.ivan-golovic.from.hr" />
</head>
<body id="doc1" onmousemove="mMove(event)">
<!--news-->
<div id="divNews" onmouseover="stopRevolve()" onmouseout="revolve()"><?php include("news.php") ?></div>
<!--language-->
<div id="divParent" onmouseout="returnSlideDiv(event,_timer)">
<div id="bckg" style="left:<?php echo $_SESSION['lang'] == "cro" ? "0px" : "70px" ?>"></div>
<div id="d1" align="center" class="flag"><a href="index.php?lang=cro" style="outline:none" onmouseover="_timer=slideLeft(_timer)"><img class="imgFlag" alt="" src="res/cro.png" /></a></div><div id="d2" align="center" class="flag" style="left:70px"><a href="index.php?lang=eng" style="outline:none" onmouseover="_timer = slideRight(_timer)"><img class="imgFlag" alt="" src="res/eng.png" /></a></div>
</div>
<!--left menu-->
<div id="leftMenu">
<div id="phome" onclick="show('home')" class="mH hom"><span class="mhT"><?php echo $aboutSite ?></span></div>
<div id="divhome" class="mC" style="width:182px; height:0px;"><div id="tblhome" class="mC2"><img alt="" src="res/pixel.gif" class="mD" /><a class="lc" onclick="showPart('Homepage');return false;" href=""><?php echo $frontpage ?></a><img alt="" src="res/pixel.gif" class="mD" /><a class="lc" onclick="showPart('Technical');return false;" href=""><?php echo $technicalDetails ?></a></div>
</div>
<div id="paboutme" onclick="show('aboutme')" class="mH abo"><span class="mhT"><?php echo $about_me ?></span></div>
<div id="divaboutme" class="mC" style="width:182px;height:0px"><div id="tblaboutme" class="mC2"><img alt="" src="res/pixel.gif" class="mD" /><a class="lc" onclick="showPart('MyData');return false;" href=""><?php echo $cv ?></a><img alt="" src="res/pixel.gif" class="mD" /><a class="lc" onclick="showPart('Leisure');return false;" href=""><?php echo $leisure ?></a></div>
</div>
<div id="pfavs" onclick="show('favs')" class="mH fav"><span class="mhT"><?php echo $favorites ?></span></div>
<div id="divfavs" class="mC" style="width:182px;height:0px;"><div id="tblfavs" class="mC2"><img alt="" src="res/pixel.gif" class="mD" /><a class="lc" onclick="showPart('FavProgram');return false;" href=""><?php echo $favprogs ?></a><img alt="" src="res/pixel.gif" class="mD" /><a class="lc" onclick="showPart('FavLinks');return false;" href=""><?php echo $favlinks ?></a></div>
</div>
<div id="pcontact" onclick="show('contact')" class="mH con"><span class="mhT"><?php echo $guestbook ?></span></div>
<div id="divcontact" class="mC" style="width:182px;height:0px;"><div id="tblcontact" class="mC2"><img alt="" src="res/pixel.gif" class="mD" /><a class="lc" onclick="showPart('Guestbook');return false;" href=""><?php echo $signguestbook ?></a><img alt="" src="res/pixel.gif" class="mD" /><a class="lc" onclick="showPart('Cf');return false;" href=""><?php echo $contactForm ?></a></div>
</div></div>
<!--letters-->
<div id="divLetters" class="anim" style="overflow:hidden;top:97px"><div id="divLetters2" class="anim" style="top:0px;"></div></div>
<div id="al2">
<div class="alTop2" onmousedown="mDownHandler2(event)" onmouseup="mUpHandler2(event)"><span id="alTitle2" class="alSpan"></span></div>
<div class="alMiddle2" style="padding:0px">
<span id="alText2" class="alSpan" style="overflow:auto; height:400px"></span><br /><br />
<button id="btnOk2" class="submit" type="button" style="margin-left:266px" onclick="unNotify2()">OK</button>
</div><div class="alBottom2"></div></div>
<div id="map"></div><a href="" name="top" id="top"></a>
<div id="ldr" class="loader" style="display:none; top:0px; left:0px"><div class="loader2"></div></div>
<div style="padding:10px;" class='topDiv' id="divImage"></div>
<div class='no topDiv' id="divNotice"><?php echo $_SESSION['lang'] == "cro" ? "Za zatvaranje kliknite na sliku" : "Click image to close" ?></div>
<div onclick="closeImage()" class='no topDiv' style="cursor:pointer" id="divCloseLoc"><img alt="" src="res/close.png" style="margin-bottom:-3px" /><?php echo $_SESSION['lang'] == "cro" ? "Kliknite ovdje za zatvaranje" : "Click here to close" ?></div>
<div style="display:none" id="divShade"></div>
<table id="tl" style="height:100%;width:100%;" cellpadding="0" cellspacing="0">
<tr><td></td><td valign="top">
<table class="mTbl" align="center" cellpadding="0" cellspacing="0">
<tr><td class="b3top"></td></tr><tr><td class="b3">
<table align="center" cellpadding="0" cellspacing="0">
<tr><td colspan="3" class="tb1"></td></tr>
<tr><td colspan="3" class="mb1"></td></tr>
<tr valign="top"><td id="conL" align="right" style="padding-right:4px">
<!--save place(left menu)-->
<img alt="" src="res/pixel.gif" style="height:233px; width:1px" />
<!--skin-->
<div class="wd1"><div class="wd2"></div><div class="wd3"><div class="skinDiv"><form id="formSkin" action="index.php" method="post" style="height:20px;"><span class="text" style="display:inline; top:5px; left:3px">Skin:</span><select name="sSkin" onchange="document.getElementById('formSkin').submit()" class="text selSkin"><option value="skin2" <?php if($selectedSkin == "skin2"){ echo 'selected="selected"';} ?> >BlackGlass</option><option value="skin1" <?php if($selectedSkin == "skin1"){ echo 'selected="selected"';} ?> >TurquoiseGlass</option></select></form></div></div><div class="wd4"></div></div>
<!--calendar-->
<div class="wd1"><div class="wd2"></div><div class="wd3"><table cellpadding="0" cellspacing="0" class="wdgTable">
<tr><td valign="top" class="wdgNW" style="height:36px;width:60px;"><img alt="" class="wiCal" src="res/pixel.gif" /></td><td class="wdgNE" valign="top" style="padding-top:3px; padding-left:20px; width:100px;"><?php echo $calendar ?></td></tr>
<tr><td id="tdCal" valign="bottom" class="wdgWSE" colspan="2" style="height:45px; padding-left:0px"><?php include("calendar.php") ?></td></tr>
</table>
<table cellpadding="0" cellspacing="0" class="ct">
<tr><td class="cal2 ct" style="height:35px;width:160px" colspan="2"><?php echo $calendarText ?></td></tr>
<tr><td class="cal2" style="height:15px;width:180px;" colspan="2"><img alt="" src="res/pixel.gif" class="img1" style="border:1px white solid" /><span style="padding-right:10px"><?php echo $holidays ?></span><img alt="" src="res/pixel.gif" class="img1" style="border:1px orange solid" /><?php echo $today ?></td></tr>
</table></div><div class="wd4"></div></div>
<!--login-->
<div class="wd1"><div class="wd2"></div><div class="wd3"><form style="margin:0px;padding:0px" action="" id="formLogin"><table cellpadding="0" cellspacing="0" class="wdgTable">
<tr><td valign="top" class="wdgNW" style="height:36px;width:60px;"><img alt="" class="wiAdm" src="res/pixel.gif" /></td><td class="wdgNE" valign="top" style="padding-top:3px; width:100px;">Login</td></tr>
<tr><td valign="bottom" class="wdg" colspan="2" style="height:22px"><?php echo $usernameLogin ?></td></tr>
<tr><td valign="top" class="wdg log" colspan="2"><input maxlength="20" id="inpUser" type="text" class="inp" /></td></tr>
<tr><td valign="bottom" class="wdg" colspan="2" style="height:22px"><?php echo $passwordLogin ?></td></tr>
<tr><td valign="top" class="wdg log" colspan="2"><input maxlength="20" id="inpPass" type="password" class="inp" /></td></tr>
<tr><td valign="middle" align="right" class="wdgWSE" colspan="2" style="padding-right:5px; height:35px"><button class="submit" type="button" onclick="sendAjaxPassCheck()">Login</button></td></tr>
</table></form></div><div class="wd4"></div></div>
</td>
<td align="left" style="padding-left:3px;padding-right:3px">
<table cellpadding="0" cellspacing="0">
<tr><td id="tdTitle" class="title sb1" colspan="3"></td></tr>
<tr><td class="nw"></td><td class="n"></td><td class="ne"></td></tr>
<tr><td class="w"></td><td class="m"><div class="text" style="width:520px;" id="divMainContent"></div><div id="pageTop" class="text" align="right" style="width:100%;display:block"><a style="text-decoration:underline;color:#999999;" href="#top" class="text">:: <?php echo $pagetop ?> ::</a></div></td><td class="e"></td></tr>
<tr><td class="sw"></td><td class="s"></td><td class="se"></td></tr>
<tr><td><img alt="" src="res/pixel.gif" style="height:1px;width:11px" /></td><td><img alt="" src="res/pixel.gif" style="height:1px;width:500px" /></td><td><img alt="" src="res/pixel.gif" style="height:1px;width:11px" /></td></tr>
</table>
</td><td id="conR" align="left" style="padding-left:4px; padding-top:4px">
<!--save place (language)-->
<div class="wd1" id="w1"><div class="wd2" id="w2"></div><div class="wd3" id="w3"><img alt="" src="res/pixel.gif" id="im" style="width:50px;height:25px" /></div><div class="wd4" id="w4"></div></div>
<!--save place, container (news)-->
<div id="divNews2"><div class="wd1"><div class="wd2"></div>
<div class="wd3"><table cellspacing="0" cellpadding="0" class="wdgTable">
<tr><td valign="top" class="wdgNW" style="height:35px;width:60px;"><img alt="" class="wiArr" src="res/pixel.gif" /></td><td class="wdgNE" valign="top" style="padding-top:3px; width:100px;"><?php echo $news ?></td></tr>
<tr><td class="wdgWSE" colspan="2" style="height:170px;padding-left:0px;"></td></tr>
</table></div><div class="wd4"></div></div></div>
<!--site search-->
<div class="wd1"><div class="wd2"></div><div class="wd3" style="height:23px;"><form id="formSearch" action="" method="post" style="height:20px;"><input maxlength="20" onfocus="mFocusSearch()" onkeydown="return isEnter(event);" onblur="mBlurSearch()" type="text" class="text" id="inpSearch" style="font-style:italic" value="<?php echo $search ?>" /><img onclick="_search();" alt="" class="imgSearch" src="res/pixel.gif" /></form></div><div class="wd4"></div></div>
<!--validation-->
<div class="wd1"><div class="wd2"></div><div class="wd3" style="height:25px;">
<p class="vp"><a href="http://validator.w3.org/check?uri=referer"><img class="vi" onmouseover="gotMouse2('Xht')" onmousemove="moveFollower2(event)" onclick="lostMouse2('Xht')" onmouseout="lostMouse2('Xht')" src="res/xht.png" alt="" /></a></p>
<p class="vp"><a href="http://jigsaw.w3.org/css-validator/check/referer"><img class="vi" onmouseover="gotMouse2('Css')" onmousemove="moveFollower2(event)" onclick="lostMouse2('Css')" onmouseout="lostMouse2('Css')" src="res/css.gif" alt="" /></a></p>
</div><div class="wd4"></div></div>
<!--poll-->
<div class="wd1"><div class="wd2"></div><div class="wd3">
<table id="tbPoll" cellpadding="0" cellspacing="0" class="wdgTable">
<tr><td valign="top" class="wdgNW" style="height:36px;width:60px;"><img alt="" src="res/pixel.gif" class="wiArr" /></td><td class="wdgNE" valign="top" style="padding-top:3px; width:100px;"><?php echo $poll ?></td></tr>
<tr><td valign="bottom" class="wdg" colspan="2" style="height:45px"><?php echo $pollText ?></td></tr>
<tr><td align="center" class="wdg" valign="middle" colspan="2" style=" height:57px;padding-left:0px;">
<form action="" id="formPoll" style="width:120px"><div id="divPollStars" style="width:120px;height:27px;" onmouseover="psVote(event)" onmouseout="psResults(event)">
<div id="hoverEffect" style="display:none;"><img alt="" id="imgStar1" onclick="if(checkVoted()){sendAjaxPoll('1');}" style="cursor:pointer" onmouseover="psHover('1')" src="res/star0.png" /><img alt="" id="imgStar2" onclick="if(checkVoted()){sendAjaxPoll('2');}" style="cursor:pointer" onmouseover="psHover('2')" src="res/star0.png" /><img alt="" id="imgStar3" onclick="if(checkVoted()){sendAjaxPoll('3');}" style="cursor:pointer" onmouseover="psHover('3')" src="res/star0.png" /><img alt="" id="imgStar4" onclick="if(checkVoted()){sendAjaxPoll('4');}" style="cursor:pointer" onmouseover="psHover('4')" src="res/star0.png" /><img alt="" id="imgStar5" onclick="if(checkVoted()){sendAjaxPoll('5');}" style="cursor:pointer" onmouseover="psHover('5')" src="res/star0.png" /></div>
<div id="realResults" style="display:block"><?php include("site_poll.php") ?></div></div></form>
</td></tr>
<tr><td valign="top" class="wdg" colspan="2" style="height:30px"><label style="color:#999999;" id="lbPollMsg"><?php echo $pollText2 ?></label></td></tr>
<tr><td valign="middle" class="wdg" colspan="2" style="height:25px"><?php echo $pollText3 ?><label id="lbVotesCount"><?php echo $votesCount ?></label></td></tr>
<tr><td valign="middle" class="wdgWSE" colspan="2" style="height:25px"><?php echo $pollText4 ?><label id="lbGrade"><?php echo $avg ?></label></td></tr>
</table></div><div class="wd4"></div></div>
</td></tr>
<tr><td id="f" colspan="3" class="text" align="center"><br /><br />&copy; <?php echo $igolovic ?> 2009.</td></tr>
</table>
</td></tr><tr><td class="b3bottom"></td></tr><tr><td><img alt="" src="res/pixel.gif" style="width:945px;height:1px" /></td></tr><tr><td>
<div class="ttc" id="divHtm"><div class="ttip1"><?php echo $html ?></div><div class="ttip2"><?php echo $html2 ?></div></div>
<div class="ttc" id="divJav"><div class="ttip1"><?php echo $js ?></div><div class="ttip2"><?php echo $js2 ?></div></div>
<div class="ttc" id="divPhp"><div class="ttip1"><?php echo $php ?></div><div class="ttip2"><?php echo $php2 ?></div></div>
<div class="ttc" id="divSql"><div class="ttip1"><?php echo $sql ?></div><div class="ttip2"><?php echo $sql2 ?></div></div>
<div class="ttc" id="divTech"><div class="ttip1"><?php echo $tech ?></div><div class="ttip2"><?php echo $tech2 ?></div></div>
<div class="ttc" id="divPics"><div class="ttip1"><?php echo $pic ?></div><div class="ttip2"><?php echo $pic2 ?></div></div>
<div class="ttc" id="divXht"><div class="ttip1"><?php echo $xht ?></div><div class="ttip2"><?php echo $xht2 ?></div></div>
<div class="ttc" id="divCss"><div class="ttip1"><?php echo $css ?></div><div class="ttip2"><?php echo $css2 ?></div></div>
<div class="ttc" id="divFac"><div class="ttip1"><?php echo $fac ?></div><div class="ttip2"><?php echo $fac2 ?></div></div>
<div class="ttc" id="divCof"><div class="ttip1"><?php echo $cof ?></div><div class="ttip2"><?php echo $cof2 ?></div></div>
<div class="ttc" id="divCv"><div class="ttip1"><?php echo $_cv ?></div><div class="ttip2"><?php echo $_cv2 ?></div></div>
<div class="ttc" id="divCms"><div class="ttip1"><?php echo $_cms ?></div><div class="ttip2"><?php echo $_cms2 ?></div></div>
<div class="ttc" id="divCmsA"><div class="ttip1"><?php echo $_cmsA ?></div><div class="ttip2"><?php echo $_cmsA2 ?></div></div>
</td></tr></table></td><td></td></tr></table>
<div id="al" onmousedown="mDownHandler(event)" onmouseup="mUpHandler(event)" style="position:absolute; top:0px; left:0px; display:none; z-index:11">
<div class="alTop"><span id="alTitle" class="alSpan"></span></div>
<div class="alMiddle" style="padding:0px">
<span id="alText" class="alSpan"></span><br /><br /><button id="btnOk" class="submit" type="button" style="margin-left:135px" onclick="unNotify()">OK</button>
</div><div class="alBottom"></div></div>
<!-- <div class="hdc"></div> -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17751996-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>