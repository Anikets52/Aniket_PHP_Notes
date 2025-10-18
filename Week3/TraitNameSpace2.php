<?php

namespace App\Traits;

trait Timestampable
{
    public function getTimestamp(): string
    {
        return date('Y-m-d H:i:s');
    }
}

namespace App\Models;

use App\Traits\Timestampable as Time;   //Alias the Fully Qualified Namespace to an Alias

class Post
{
    use Time;

    public function save(): string
    {
        return "Post saved at " . $this->getTimestamp();
    }
}

namespace App;

use App\Models\Post;

$post = new Post();
echo $post->save();

// $a = "j";
// printf("hello %d!", $a);
// $x = 12222;

// eval("\$y = \"$x\";");
// echo $y;
