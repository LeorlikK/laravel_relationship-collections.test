<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Services\ServiceClass;
use App\Services\ServiceDopClass;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use Tests\TestCase;

class PostTest extends TestCase
{
    private ServiceInterface $testObj;
    private Collection $postsCollections;

    public function setUp(): void
    {
        parent::setUp();

        $daysSchedule = [11, 12, 13];
        $hoursSchedule = [14, 15, 16];
        $this->app->bind(ServiceInterface::class, function () use ($daysSchedule, $hoursSchedule) {
            return new ServiceClass($daysSchedule, $hoursSchedule);
        });

    }

    public function test_example(ServiceInterface $service)
    {
        $service->getOneArray();
    }

    public function testLazy()
    {
        // До начала цикла stage
        $posts = new Collection();

        $lazy = LazyCollection::make(function ()use($posts){
            foreach ($posts as $post) {
                echo "Return yield" . PHP_EOL;
                yield $post;
            }
        });

        $posts = Post::where('id', '>', 10)->where('id', '<', 20)->get();
        $lazy = $lazy->merge($posts);
        dump(['count' => $lazy->count()]);

        // После цикла stage
        echo 'START' . PHP_EOL;
        foreach ($lazy->chunk(3) as $l) {
//            echo "$l->id" . PHP_EOL;
//            echo "$l->id => ID" . PHP_EOL;
//            echo PHP_EOL;
            DB::transaction(function () use ($l){
                $l->each(function (Post $p){
                    dump($p->id, $p->body);
                    $p->id >= 15 ? $param = 999 : $param = 777;
                    $p->update(['body' => $param]);
                });
            });

        }

    }

    public function testMyTestTwo()
    {
        $posts = Post::where('id', '>', 10)->where('id', '<', 20)->get();
        $posts->map(function ($item){
            return  $item->body = 1996;
        });
        dump($posts);
    }
}


