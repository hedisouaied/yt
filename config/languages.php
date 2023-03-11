<?php

//use App\Models\Language;
$host = env('DB_HOST');
$user =  env('DB_USERNAME');
$pass =  env('DB_PASSWORD');
$db =  env('DB_DATABASE');

$conn = mysqli_connect($host, $user, $pass, $db);
$columns = [];
$req ="SELECT * FROM languages";
$exec = mysqli_query($conn,$req);
while($array=mysqli_fetch_array($exec)){
    $columns[$array['code']] = $array['name'];
}
return $columns;
/*$langs = App\Models\Language::get();
foreach($langs as $lang1){
    $columns[$lang1->code] = $lang1->name;
}
return $columns;
return [
    'en' => 'English',
    'it' => 'Italian',
    'fr' => 'Français',
    'es' => 'Spanish'
];*/
