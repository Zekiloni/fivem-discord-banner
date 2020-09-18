<?php
// FIVEM SERVER & DISCORD BANNER

header('Content-Type: image/png');

// SETITINGS
$server_name = "Cuba Test Roleplay"; // PUT HERE SERVER NAME (betwen "")
$server_site = "www.roleplay.com"; // PUT HERE SERVER SITE (betwen "")
$ip = "fivem.redtown.lt"; // PUT SERVER IP (betwen "")
$port = "30120"; // PUT SERVER PORT (betwen "")
$discord_id = "705589413958123676"; // DISCORD SERVER ID (Server Settings > Widget) (betwen "")

// BACKGROUND
$stil = imagecreatefrompng('assets/images/style_1.png');

// FIVEM JSON
$info = json_decode(file_get_contents("http://".$ip.":".$port."/info.json"), true);
$players = file_get_contents("http://".$ip.":".$port."/players.json");
$online_players = json_decode($players, true);
$players_counts = count($online_players);
$max_clients = $info['vars']['sv_maxClients'];

// DISCORD JSON
$discord = json_decode(file_get_contents("https://discordapp.com/api/guilds/".$discord_id."/widget.json"), true)['members'];
$membersCount = 1;
foreach ($discord as $member) {
    if ($member['status'] == 'online') {
        $membersCount++;
    }
}

if(isset($discord['instant_invite'])) {
	$invite_link = $discord['instant_invite'];
} else { 
	$invite_link = " / ";
}

// COLORS 
$BOJA_CRNA = imagecolorallocate($stil, 0, 0, 0); 
$COLOR_WHITE = imagecolorallocate($stil, 255, 255, 255);
$BOJA_CRVENA = imagecolorallocate($stil, 255, 0, 24);
$COLOR_ONLINE = imagecolorallocate($stil, 57, 181, 74);
$BOJA_ORANGE = imagecolorallocate($stil, 255, 153, 51);
$COLOR_GREY = imagecolorallocate($stil, 213, 221, 229);

// FONTS
$FONT = "D:/xampp/htdocs/fivem_banner/assets/fonts/Roboto-Regular.ttf"; // PUT FONT ROOT
$FONTL = "D:/xampp/htdocs/fivem_banner/assets/fonts/Roboto-Light.ttf"; // PUT FONT ROOT

// SERVER TITTLE BOX
imagettftext($stil, 18, 0, 15, 40, $COLOR_WHITE, $FONTL, $server_name);
imagettftext($stil, 10, 0, 15, 55, $COLOR_WHITE, $FONT, $server_site);
$fivem = imagecreatefrompng('assets/images/fivem_logo.png'); // FIVEM LOGO
imagecopy($stil, $fivem, 530, 10, 0, 0, 50, 50); // FIVEM LOGO DISPLAYING

$discord = imagecreatefrompng('assets/images/discord_logo.png'); // DISCORD LOGO
imagecopy($stil, $discord, 10, 80, 0, 0, 50, 50); // DISCORD LOGO DISPLAYING

// BOX 2 
imagettftext($stil, 18, 0, 70, 115, $COLOR_WHITE, $FONT, "INVITE LINK:");
imagettftext($stil, 18, 0, 70, 145, $COLOR_WHITE, $FONTL, $invite_link);
imagettftext($stil, 18, 0, 70, 185, $COLOR_ONLINE, $FONTL, "ONLINE");
imagettftext($stil, 18, 0, 170, 185, $COLOR_WHITE, $FONT, $membersCount);

// BOX 3
imagettftext($stil, 10, 0, 430, 221, $COLOR_WHITE, $FONT, "FIVEM SERVER BANNER");
imagettftext($stil, 35, 0, 475, 130, $COLOR_WHITE, $FONT, $players_counts);
imagettftext($stil, 14, 0, 492, 155, $COLOR_WHITE, $FONT, $max_clients);
imagettftext($stil, 14, 0, 478, 155, $COLOR_WHITE, $FONT, "/");
imagettftext($stil, 15, 0, 420, 180, $COLOR_ONLINE, $FONTL, "ONLINE PLAYERS");

imagepng($stil);
imagedestroy($stil);
?>