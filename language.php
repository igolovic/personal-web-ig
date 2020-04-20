<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if(isset($_GET['lang']))
{
	if($_GET['lang'] == "cro")
	{
		$_SESSION['lang'] = "cro";
	}
	else
	{
		$_SESSION['lang'] = "eng";
	}
}

if(!isset($_SESSION['lang']))
{
	$_SESSION['lang'] = "cro";
}

if($_SESSION["lang"] == "cro")
{
$typingMsg = "'Dobrodošli! Hvala na iskazanom interesu!', 'Ovdje možete saznati više o meni i mojem radnom iskustvu.', 'Možete ostaviti komentar i dati ocjenu sajtu.'";
$personalHomepage = "Osobna stranica";
$aboutSite = "O sajtu";
$about_me = "O meni";
$favorites  = "Moji favoriti";
$guestbook = "Guestbook i kontakt";
/////////////////////////////
$frontpage = "Početna stranica";
$technicalDetails = "Tehnički detalji";
$cv = "Životopis";
$leisure = "Izvan posla";
$favprogs = "Omiljeni programi";
$favlinks = "Omiljeni linkovi";
$signguestbook = "Guestbook";
$contactForm = "Kontakt obrazac";
////////////////////////////
$calendar = "Kalendar";
$calendarText = "Postavite miš nad označeni datum da bi vidjeli tekst";
$holidays = "Blagdani";
$today = "Danas";
//////////////////////////////
$pagetop = "na vrh stranice";
//////////////////////////////
$search = "Pretraga sajta";
//////////////////////////////
$usernameLogin = "Korisničko ime";
$passwordLogin = "Lozinka";
/////////////////////////////
$poll = "Anketa";
$pollText = "Ovdje možete dati ocjenu sajtu";
$pollText2 = "Da biste glasali kliknite zvjezdicu";
$pollText3 = "Broj glasova:&nbsp;";
$pollText4 = "Trenutačna ocjena:&nbsp;";
$news = "Novosti";
///////////////////////////////
$signhere = "Ovdje možete upisati vaš komentar";
$gName = "Ime";
$gComment = "Komentar";
$gSend = "Pošalji";
$availableCharMsg = " znakova na raspolaganju";
//////////////////////////////
$cfName = "Ime";
$cfEmail = "E - mail";
$cfMessage = "Poruka";
$cfSent = "Poruka je poslana, hvala.";
//////////////////////////////
$js = "Učenje Javascript-a";
$js2= "Koristan Javascript tutorial zajedno sa značenjima svih funkcija.";
$html = "Učenje HTML-a";
$html2= "Tutorial sa objašnjenjima značenja svih HTML tagova.";
$php = "Učenje PHP-a";
$php2= "Tutorial za učenje PHP-a. Jako koristan za početnike.";
$sql = "Učenje SQL-a";
$sql2= "Tutorial za učenje SQL-a zajedno s primjerima.";
$pic = "Galerije slika";
$pic2= "Ovdje možete pogledati slike rijeke Drave i pokrajne Vorarlberg u Austriji.";
$xht = "Kliknite za XHTML provjeru";
$xht2= "Ovaj sajt pridžava se W3C XHTML standarda.";
$css = "Kliknite za CSS provjeru";
$css2= "Ovaj sajt pridžava se W3C CSS standarda.";
$fac = "Facebook";
$fac2= "Ovo je moj account na Facebook-u.";
$cof= "Kontakt obrazac";
$cof2= "Ovdje možete ispuniti kontakt obrazac.";
$_cv= "Reference i životopis";
$_cv2= "Ovdje možete pogledati moje reference i životopis.";
$_cms= "Javni dio CMS-a";
$_cms2= "Ovdje možete pogledati javni dio CMS-a.";
$_cmsA= "Administrativni dio CMS-a";
$_cmsA2= "Ovdje možete pogledati administrativni dio CMS-a.";
//////////////////////////////////////////////
$title = "Osobna stranica - Ivan Golović";
$igolovic = "Ivan Golović";
}

if($_SESSION["lang"] == "eng")
{
$typingMsg = "'Welcome! Thank you for visiting.', 'Here you can find out more about me and my work experience.', 'You can also leave a comment and rate this site in a web poll.'";
$personalHomepage = "Personal homepage";
$aboutSite = "About site";
$about_me = "About me";
$favorites  = "My favourites";
$guestbook = "Guestbook &amp; Contact";
/////////////////////////////
$frontpage = "Frontpage";
$technicalDetails = "Technical details";
$cv = "Curriculum Vitae";
$leisure = "Leisure";
$favprogs = "Software";
$favlinks = "Links";
$signguestbook = "Guestbook";
$contactForm = "Contact form";
////////////////////////////
$calendar = "Calendar";
$calendarText = "Hover mouse over the highlighted dates to see the comment";
$holidays = "Holidays";
$today = "Today";
//////////////////////////////
$pagetop = "go to the page top";
//////////////////////////////
$search = "Site search";
//////////////////////////////
$usernameLogin = "Username";
$passwordLogin = "Password";
/////////////////////////////
$poll = "Site poll";
$pollText = "Here you can give your rating of this site";
$pollText2 = "Click on a star to vote";
$pollText3 = "Number of votes:&nbsp;";
$pollText4 = "Current rating:&nbsp;";
$news = "News";
///////////////////////////////
$signhere = "Write your comment here";
$gName = "Name";
$gComment = "Comment";
$gSend = "Send";
$availableCharMsg = " characters available";
//////////////////////////////
$cfName = "Name";
$cfEmail = "E - mail";
$cfMessage = "Message";
$cfSent = "Message was sent, thank you.";
//////////////////////////////
$js = "Learn Javascript";
$js2= "Javascript tutorial together with explanations of all the functions";
$html = "Learn HTML";
$html2= "Useful tutorial with complete HTML reference.";
$php = "Learn PHP";
$php2= "Tutorial for learning PHP. Very useful for beginners.";
$sql = "Learn SQL";
$sql2= "Tutorial for learning SQL together with examples.";
$pic = "Picture galleries";
$pic2= "Take a look at the photos of river Drava and province of Vorarlberg in Austria.";
$tech = "Technical details";
$tech2= "Here you can take a look at the technical features of this site.";
$xht = "Click for XHTML validation";
$xht2= "This site is W3C XHTML compliant.";
$css = "Click for CSS validation";
$css2= "This site is W3C CSS compliant.";
$fac = "Facebook";
$fac2= "This is my Facebook account.";
$cof= "Contact form";
$cof2= "Here you can fill in a contact form.";
$_cv= "References and CV";
$_cv2= "Here you can take a look at my references and CV.";
$_cms= "Public part of CMS";
$_cms2= "Here you can take a look at the public part of CMS.";
$_cmsA= "Administrative part of CMS";
$_cmsA2= "Here you can take a look at the administrative part of CMS.";
//////////////////////////////////////////////
$title = "Personal homepage - Ivan Golovic";
$igolovic = "Ivan Golovic";
}
echo "<script type='text/javascript'>var frontpage='".$frontpage."',technicalDetails='".$technicalDetails ."',
cv='".$cv."',leisure='".$leisure."',favprogs='".$favprogs."',favlinks='".$favlinks."',guestbook='".$signguestbook."',
contactForm='".$contactForm."',cfSent='".$cfSent."',messages=new Array(" . $typingMsg . "),availableCharMsg='" . $availableCharMsg. "',
lang='" . ($_SESSION['lang'] == "cro" ? "cro" : "eng") . "',alString='" . ($_SESSION['lang'] == "cro" ? "Obavijest" : "Notification") . "',
searchResults='" . ($_SESSION['lang'] == "eng" ? "Search results" : "Rezultati pretrage") . "',
badSearch='" . ($_SESSION['lang'] == "eng" ? "No search words entered." : "Niste unijeli tekst pretrage.") . "',
badLogin='" . ($_SESSION['lang'] == "eng" ? "Wrong password or username." : "Kriva lozinka ili korisničko ime.") . "',
noDataText='" . ($_SESSION['lang'] == "cro" ? "Niste unijeli sve potrebne podatke" : "Required entry was not supplied") . "'
</script>";

?>