<?php
// Routes

$app->get('/install', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");



    $this->db;
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule::schema()->dropIfExists('articles');
    $capsule::schema()->create('articles', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->increments('id');
        $table->string('Title');
        $table->string('Comment');
        $table->string('Summary');
        $table->string('ImageArticle');
        $table->date("Online");
      
        // Include created_at and updated_at
        $table->timestamps();
    });


    $DefaultArticle = new Article;
    $DefaultArticle->Title = "Morning";
    $DefaultArticle->Comment = "I like it";
    $DefaultArticle->Summary = "It was the best tea I've never had";
    $DefaultArticle->ImageArticle="Morning.jpg";


    $DefaultArticle->save();

    $DefaultArticle2 = new Article;
    $DefaultArticle2->Title = "Evening";
    $DefaultArticle2->Comment = "Work a lot";
    $DefaultArticle2->Summary = "It's time to be great in this world";
    $DefaultArticle2->ImageArticle="Evening.jpg";

    $DefaultArticle2->save();


    $DefaultArticle3 = new Article;
    $DefaultArticle3->Title = "Japan";
    $DefaultArticle3->Comment = "I really enjoy it";
    $DefaultArticle3->Summary = "I want to go back and finish to learn again";
    $DefaultArticle3->ImageArticle="Japan.jpg";

    $DefaultArticle3->save();


   


$articles=Article::all();

return $this->renderer->render($response, 'Articles.phtml', ["Articles"=>$articles]);
});


$app->get('/', function ($request, $response, $args) {
   $this->db;

 

  $articles=Article::all();

 return $this->renderer->render($response, 'Articles.phtml', ["Articles"=>$articles]);
});



$app->get('/article/[{n}]', function ($request, $response, $args) {
   $this->db;

    $ArticleNumber=(int) $args['n'];

    //echo $n1;

  $OneArticle=Article::find($ArticleNumber);
  return $this->renderer->render($response, 'OneArticle.phtml', ["OneArticle"=>$OneArticle]);
});




$app->get('/add', function ($request, $response, $args) {


return $this->renderer->render($response, 'CreateArticle.phtml',$args);
});




$app->post('/add', function ($request, $response, $args) {
  $this->db;

$ar= new Article;

$ar->Title= $_POST['title'];
$ar->Comment= $_POST['comment'];
$ar->Summary= $_POST['summary'];
$ar->ImageArticle= $_POST['imageArticle'];
$ar->save();


$articles=Article::all();
return $this->renderer->render($response, 'Articles.phtml', ["Articles"=>$articles]);
});



$app->get('/sub/[{n}]', function ($request, $response, $args) {
  $this->db;

$ArticleNumber=(int) $args['n'];

 Article::destroy($ArticleNumber);



$articles=Article::all();
return $this->renderer->render($response, 'Articles.phtml', ["Articles"=>$articles]);
});






$app->get('/upd/[{n}]', function ($request, $response, $args) {
$this->db;

  $ArticleNumber=(int) $args['n'];
  $a=Article::find($ArticleNumber);

return $this->renderer->render($response, 'UpdateArticle.phtml',["Uarticle"=>$a]);
});




$app->post('/upd/[{n}]', function ($request, $response, $args) {
  $this->db;

   $n1=(int) $args['n'];

    //echo $n1;

    $ar=Article::find($n1);
    $ar->Title= $_POST['title'];
    $ar->Comment= $_POST['comment'];
    $ar->Summary= $_POST['summary'];
    $ar->save();


$articles=Article::all();

return $this->renderer->render($response, 'Articles.phtml', ["Articles"=>$articles]);
});



$app->get('/ContactUs', function ($request, $response, $args) {
return $this->renderer->render($response, 'ContactUs.phtml',$args);
});


$app->get('/Right', function ($request, $response, $args) {
return $this->renderer->render($response, 'Right.phtml',$args);
});



$app->post('/file', function ($request, $response, $args) {
  
return $this->renderer->render($response, 'file.phtml',$args);
});

