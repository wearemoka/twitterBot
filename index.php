<?php
// http://techiella.x0.com/twitter-search-using-the-twitter-api-php/
require "vendor/autoload.php";
use DevCoder\DotEnv;
use Abraham\TwitterOAuth\TwitterOAuth;
(new DotEnv(__DIR__ . '/.env'))->load();

define('CONSUMER_KEY', getenv('CONSUMER_KEY'));
define('CONSUMER_SECRET', getenv('CONSUMER_SECRET'));
define('ACCESS_TOKEN', getenv('ACCESS_TOKEN'));
define('ACCESS_TOKEN_SECRET', getenv('ACCESS_TOKEN_SECRET'));

function search(array $query) {
  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  return $toa->get('search/tweets', $query);
}
function follow($id) {
  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  $toa->post('friendships/create', array('user_id' => $id));
}

function tweet($content, $tweetid) {
  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  $toa->post('statuses/update', array('status' => $content, 'in_reply_to_status_id' => $tweetid));
}

$input = array("phrase1", "phrase2", "phrase3", "phrase4");
$tips = array(
  "phrase1"  => "answer1",
  "phrase2"  => "answer2",
  "phrase3"  => "answer3",
  "phrase4"  => "answer4"
);

$k = array_rand($input);
echo $random=$input[$k];

$query = array(
  "q" => "\"$random\"",
);

$results = search($query);

foreach ($results->statuses as $result) {
   echo "<hr>";
   echo $result->user->screen_name . ": " . $result->text . "\n";
}

echo "<hr>";
echo "<hr>";

echo "<hr>";echo "<hr>";echo "<hr>";echo "<hr>";echo "<hr>";echo "<hr>";
echo "User selected: @".$result->user->screen_name;
$user=$result->user->screen_name;
$id=$result->id;
echo "<hr>";
echo "Tweet ID: ".$result->id;
echo "<hr>";
echo "<a href='https://twitter.com/$user/status/$id/' target='_blank'>Show</a>";
echo "<hr>";

echo $answer=str_replace(array_keys($tips), array_values($tips), $random);

echo "<hr>";
echo "<br>Phrase: ".$random;
echo "<br>Phrase index: ".$k;
echo "<hr>";echo "<hr>";
echo "<br>Twit:<br>";
echo "Hi! ".$answer." @".$result->user->screen_name;
echo "<hr>";echo "<hr>";
// tweet("Hi! Where is Wally??: \"".$answer."\" @".$result->user->screen_name." ;)", $id);
