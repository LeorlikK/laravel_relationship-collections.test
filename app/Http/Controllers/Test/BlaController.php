<?php

namespace App\Http\Controllers\Test;

//include_once ('controller.php');
//include_once ('UserController.php');
//include_once ('storage.php');
//include_once ('HomeController.php');
//include_once ('shop.php');
//include_once ('session.php');

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Models\ManyToManyFirst;
use App\Models\ManyToManySecond;
use App\Models\OneToManyFirst;
use App\Models\OneToManySecond;
use App\Models\OneToOneFirst;
use App\Models\OneToOneSecond;
use App\Models\Post;
use App\Services\ServiceInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;


class BlaController extends Controller
{
    public function testIp(Request $request)
    {
        $serviceIp = Http::get('https://api.ipify.org');
        $requestIp = $request->ip();
        dump($serviceIp, $requestIp);
        dump('TEST_IP');
        return true;
    }
    private string $name = 'Kirill';
//    public function __construct(ServiceInterface $service)
//    {
//\Illuminate\Http\Request $request
//        $this->service = $service;
//    }

    public function index(ServiceInterface $service, TestRequest $testRequest)
    {
        // 1 var
        $posts = $service->getOneArray(); // ServiceInterface $service

        // 2 var
//        $posts = app()->make(ServiceInterface::class);
//        $posts = $posts->getOneArray();

//        $obj = app()->make(ServiceTest::class);
//        $posts = $obj->getService();

        // 3 var
//        $posts = $this->service->getOneArray();

        return view('test', compact('posts'));
    }

    public function create(Request $request)
    {
        $request = $request->validate([
            'title' => ['string', 'unique:posts,title'],
            'slug' => ['string'],
            'body' => ['string'],
            'category_id' => ['integer']
        ]);

        $post = Post::create($request);
        return response()->json($post);
    }

    public function createTest($postData)
    {
        $request = $request->validate([
            'title' => ['string', 'unique:posts,title'],
            'slug' => ['string'],
            'body' => ['string'],
            'category_id' => ['integer']
        ]);

        $post = Post::create($request);
        return response()->json($post);
    }

    public function show(Post $post)
    {
        $newObj = app()->make(ServiceInterface::class);
//        $newObj->getOneArray();
        return$newObj->getOneArray();
        return $post;
    }

    public function queryBuilder()
    {
        $posts = Post::get();
        $posts = Post::all();
        $posts = Post::first();
        $posts = Post::value('title');
        $posts = Post::pluck('title', 'id');
        $posts = Post::pluck('title', 'id');
        $posts = Post::chunk(10, function ($post){
           foreach ($post as $p){
               $p->id == 2? $p->update(['title' => 'Post Two']) : null;
           }
//           return false;
        });
        $posts = Post::lazy(10)->each(function ($lazy){
            dump($lazy);
            echo '==================================';
        });
        $posts = Post::count('id');
        $posts = Post::max('id');
        $posts = Post::min('id');
        $posts = Post::sum('id');
        $posts = Post::avg('id');
        $posts = Post::where('id', 2)->exists();
        $posts = Post::where('id', 2)->doesntExist();
        $posts = Post::select(['title', 'id'])->get();
        $posts = Post::distinct()->get(); understand

        $query = Post::select('id');
        $posts = $query->addSelect('title')->get();

        $posts = Category::join('posts', 'categories.id', '=', 'posts.id')->get(); // ->leftJoin ->rightJoin
        $posts = Post::join('categories', 'categories.id', '=', 'posts.id')->get();

        $posts = Category::crossJoin('posts')->get();

        $query = Post::where('id', '>', 5);
        $posts = Post::where('id', '<', 15)->union($query)->get();
        $posts = $query->where('id', '<', 15)->get();

        $posts = Post::where('id', '<>', 10)->get();
        $posts = Post::where('title', 'like', '%s%')->get();
        $posts = Post::where([['id', '=', 3], ['category_id', '=', 1]])->get();
        $posts = Post::where('id', 3)->orWhere('id', '=', 115)->get(); // OR
        $posts = Post::where('id', 113)->orWhere(function ($query){
            $query->where('id', '=', 5)->where('title', 'like', '%f%');
        })->get();
        $posts = Post::whereNot(function ($query){
            $query->where('id', '>', 15)->orWhere('id', '<', 5);
        })->get();

        $posts = Post::whereBetween('id', [1, 10])->pluck('id');
        $posts = Post::whereNotBetween('id', [1, 10])->pluck('id');
        $posts = Post::whereBetweenColumns('id', ['category_id', 'body'])->get();
        $posts = Post::whereNotBetweenColumns('id', ['category_id', 'body'])->get();

        $array = Post::select('id')->where('id', '<', 6)->get();
        $posts = Post::whereIn('id', $array)->get();
        $posts = Post::whereNotIn('id', $array)->get();

        $posts = Post::whereNull('id')->get();
        $posts = Post::whereNotNull('id')->get();

        $dateOne = date('Y-m-d', mktime(12,12,12,4,7,2015));
        $dateTwo = date('Y-m-d', mktime(12,12,12,4,7,2025));
        $posts = Post::whereBetween('created_at', [$dateOne, $dateTwo])->get();

        $posts = Post::whereDate('created_at', '2022-08-13')->get();
        $posts = Post::whereYear('created_at', 2022)->get();
        $posts = Post::whereMonth('created_at', 8)->get();
        $posts = Post::whereDay('created_at', 13)->get();
        $posts = Post::whereTime('created_at', '12:29:15')->get();

        $posts = Post::whereColumn('created_at', '<','updated_at')->get();
        $posts = Post::where('id', 2)->where(function ($query){
            $query->where('title', 'asdasda')
                ->orWhere('body', 3);
        })->get();

        $posts = Post::whereExists(function ($query){
            $query->where('id', 2)
                ->where('body', 3);
        })->get();

        $posts = Post::where(function ($query){
            $query->select('id');
        }, 3)->get();

        $posts = Post::where('id', '=', function ($query){
            $query->from('posts')->select('body')->where('body', '=', 3);
        })->get();

        $posts = Post::orderBy('id', 'desc')->get();
        $posts = Post::latest('id')->get();
        $posts = Post::oldest('id')->get();
        $posts = Post::inRandomOrder()->first();

        $posts = Post::groupBy('id')->having('id', '>',5)->get();
        $posts = Post::offset(5)->limit(2)->get();

        $count = 0;
        $posts = Post::when($count, function ($query, $count){
            $query->where('id', $count);
        },function ($query, $count){
            $query->where('id', 7);
        })->get();

        $posts = Post::insertOrIgnore([
            ['id' => 24, 'title' => 'insertGetId - 2', 'slug' => 'slug', 'body' => 'test_2', 'category_id' => 1],
            ['id' => 25, 'title' => 'insertGetId - 3', 'slug' => 'slug', 'body' => 'test_3', 'category_id' => 1],
        ]);
        $posts = Post::insertGetId(
            ['title' => 'insertGetId - 1', 'slug' => 'slug', 'body' => 'test_1', 'category_id' => 1],
        );

        $posts = Post::upsert([
            ['id' => 2, 'title' => 'Post Two', 'body' => '3', 'slug' => 'kirill2']
        ],
        ['id'],
        ['body']
        );

        $posts = Post::where('id', 2)->update(['body' => 333]);
        Post::updateOrInsert(
            ['title' => 'Posts Two'],
            ['title' => 'Post Three', 'body' => '3', 'slug' => 'post_three']
        );
        $posts = Post::whereId(2)->increment('body', 1, ['title' => 'New Post']);
        $posts = Post::whereId(2)->decrement('body', 1, ['title' => 'New Post']);
        $posts = Post::where('id', 28)->delete();
        $posts = Post::where('id', '<', 100)->sharedLock()->get();
        $posts = Post::where('id', '<', 100)->lockForUpdate()->get();

//        dump($date);
        dump($posts);
        return $posts;
//        return null;
    }

    public function collections()
    {
        $collection = collect(['title', 'body', null])->map(function ($obj){
            return strtoupper($obj);
        })->reject(function ($obj){
            return empty($obj);
        });
        $collection = collect([1,2,3]);

        \Illuminate\Support\Collection::macro('plusOne', function ($args){
            return $this->map(function ($value) use($args) {
                return $value +=$args;
            });
        });

        $collection = $collection->plusOne(2)->each(function ($val){
            dump($val);
        });

        $collection = collect([[1 => 10],[2 => 20],[3 => 30]])->all();
        $collection = collect([[1 => 10],['foo' => 20],[3 => 30],['foo' => 10]])->avg('foo');
        $collection = collect([1,2,3,4,5,6,7,8,9,10])->chunk(2);
        $collection = collect(str_split('AABBCCCD'))->chunkWhile(function ($value, $key, $chunk){
            return $value !== $chunk->last();
        });
        $collection = collect([
            [1,2,3],
            ['one','two','three'],
            [7,8,9]
        ])->collapse();

        $collection = collect([1,2,3,4,5]);
        $collection = $collection->collect();

        $collectionPost = Post::limit(2)->get();
        $collectionCategory = Category::get();
        $collection = $collectionPost->combine($collectionCategory);

        $collectionPost = Post::limit(2)->get();
        $collectionCategory = Category::get();
        $collection = $collectionPost->concat($collectionCategory);

        $collectionPost = Post::limit(2)->get();
        $collection = $collectionPost->contains('body', 5); // containsStrict()
        $collection = $collectionPost->contains(function ($value, $key){
            return $value->body == 3;
        });
        $collection = $collectionPost->doesntContain('body', 5);

        $collection = $collectionPost->containsOneItem();

        $collectionPost = Post::get();
        $collection = $collectionPost->countBy('body');
        $collection = $collectionPost->countBy(function ($item){
            return $item->id > 8;
        });


        $collectionPost = collect([1,2,3,4,5,6,7,8,9,10]);
        $collection = $collectionPost->diff([1,3,5])->all();
        $collectionPost = collect(['one' => 1, 'two' => 2, 'three' => 3]);
        $collection = $collectionPost->diffAssoc(['one' => 1, '2' => 2, 'three' => 333]);
        $collectionPost = collect(['one' => 1, 'two' => 2, 'three' => 3]);
        $collection = $collectionPost->diffKeys(['one' => 1, '2' => 2, 'three' => 333]);

        $a = collect([1,2,3,4,5,6, 2, 2]);
        $collection = $a->duplicates();

        $collection = $collectionPost->each(function ($item, $key){
            dump($key);
            if ($key == 1) return null;
            return $item->body = 555;
        });

        $collection = collect([['one', 1, 'two', 2], ['three', 3, 'four', 4]]);
        $collection = $collection->eachSpread(function ($a,$b,$c,$d){
            dump($a,$b,$c,$d);
            return null;
        });

        $collection = $collectionPost->every(function ($value, $key){
           return $value->body < 5;
        });

        $array = collect(['one' => 1, 'two' => 2, 'three' => 3]);
        $collection = $array->except(['two']);
        $collection = $collectionPost->except([2]);

        $collection = $collectionPost->filter();
        $collection = $collectionPost->filter(function ($item){
            return $item->id > 2;
        });
        $collection = $collectionPost->reject(function ($item){
            return $item->id > 2;
        });

        $collection = $collectionPost->first();
        $collection = $collectionPost->first(function ($item){
            return $item->id > 2;
        });

        $collectionPost = collect([]);
        $collection = $collectionPost->firstOrFail();


        $collection = $collectionPost->firstWhere('body', 4);
        $collection = $collectionPost->search(function ($item){
            return $item->body == 777;
        });

        $collectionPost = collect([
            'arr_1' => ['lala' => 1],
            'arr_2' => 5,
            'arr_3' => ['lolo' => 2, 'dodo' => ['one' => 1, 'two' => 2]]
        ]);
        $collection = $collectionPost->flatten(1);

        $collection = $collectionPost->map(function (Post $item){
            $item = collect($item->toArray());
            return $item->flip();
        });

        $collectionPost = collect(['one' => 1, 'two' => 2, 'three' => 3]);
        $collectionPost->forget('two');

        $collectionPost = Post::get();
        $collection = $collectionPost->forPage(3, 3);

        $collectionPost = Post::get();
        $collection = $collectionPost->groupBy('id');
        $collection = $collectionPost->groupBy(function ($item){
            return $item->id;
        });

        $collectionPost = Post::get();
        $collection = $collectionPost->has([0, 1000]);
        $collection = $collectionPost->hasAny([0, 1000]);

        $collection = $collectionPost->implode('body', ', ');
        $collection = $collectionPost->implode(function ($item){
            return $item->body += 1;
        }, ', ');

        $post = Post::where('id', '>', 2)->where('id', '<', 5)->get();
        $collection = $post->intersect($collectionPost);

        $collection = $collectionPost->isEmpty();
        $collection = $collectionPost->isNotEmpty();

        $collection = $collectionPost->map(function ($item){
            return $item->body;
        })->join('+', '-');

        $collection = $collectionPost->keyBy(function ($item){
            return $item->body;
        });

        $collection = $collectionPost->keys();

        $collection = $collectionPost->last(function ($item){
            return $item->id > 2;
        });

        $collection = $collectionPost->prepend(['arrayPrepend' => 500], 5)->first();
        $collection = $collectionPost->push(['arrayPush' => 1000])->last();

        $collectionPost = Post::limit(10)->get();
        $collection = $collectionPost->pull(4);
        $collectionPost = $collectionPost->values();

        $collectionPost = Post::limit(10)->get();
        $collection = $collectionPost->sort();
        $collection = $collectionPost->sortDesc();

        $collection = $collectionPost->sortBy('body', SORT_STRING)->pluck('body');
        $collection = $collectionPost->sortByDesc('body', SORT_NUMERIC)->pluck('body');

        $collection = $collectionPost->sortBy(function ($value, $key){
            return $value->body;
        });

        $collection = $collectionPost->sortByDesc(function ($value, $key){
            return $value->body;
        });


        $collection = $collectionPost->sortBy([
            fn ($a, $b) => $a->body <=> $b->body,
            fn ($a, $b) => $b->id <=> $a->id,
        ]);

        $collection = $collectionPost->sortKeys();
        $collection = $collectionPost->sortKeysDesc();

        $collection = $collectionPost->splice(3, 3);

        $collection = $collectionPost->mapSpread(function ($value, $key){
            dump($value, $key);
            return $value->body = 534;
        });

        $collectionPost_One = Post::orderBy('id', 'desc')->limit(5)->get();
        $collection = $collectionPost->merge($collectionPost_One);

        $collection = $collectionPost->only([2,3]);

        $collection = $collectionPost->pad(100, ['arrayTest' => new Post()]);

        $collection = $collectionPost->partition(function ($item){
            return $item->id < 5;
        });

        $collection = $collectionPost->reduce(function ($carry, $item){
            dump($carry);
           return $carry->id + $item->id;
        }, new Post());

        $collection = $collectionPost->reverse()->values();


        $collection = $collectionPost->shift(2);
        $collectionPost = $collectionPost->toArray();

        $a = array_slice($collectionPost, 0,3);
        $a = array_splice($collectionPost, 0,3);
        $a = array_shift($collectionPost);
        $a = array_pop($collectionPost);

        $collection = array_slice($collectionPost->toArray(), 0, 4);
        $collection = $collectionPost->pop(2);

        $collection = $collectionPost->take(3);

        $collection = $collectionPost->toJson();

        $collection = $collectionPost->whereIn('id', [2,3,4]);
        $collection = $collectionPost->whereNotIn('id', [2,3,4]);

        $collection = $collectionPost->zip(['lolo', 'lala']);
        $arrayOne = [1,2,3];
        $arrayTwo = [4,5,6];
        $collection = array_map(null, $arrayOne, $arrayTwo);

        dump($collection);
        return $collection;

    }

    public function eloquentCollections(Request $request)
    {
//        $collectionPost = Post::limit(10)->get();

//        $collectionPost = $collectionPost->first();
//        $eloquentCollections = $collectionPost->newId;
//        dd($eloquentCollections);

//        $eloquentCollections = $collectionPost->append('newId');

//        $eloquentCollections = $collectionPost->contains(5);

//        $eloquentCollections = $collectionPost->diff(Post::whereIn('id', [1,2,3,4])->get());

//        $eloquentCollections = $collectionPost->except([5,6,7])->keyBy('id');

//        $eloquentCollections = $collectionPost->find([1,2,3,4]);

//        $eloquentCollections = $collectionPost->fresh('category');

//        $eloquentCollections = $collectionPost->intersect(Post::whereNotIn('id', [1,2,3,4,5])->get());

//        $eloquentCollections = $collectionPost->load('category');
//        $eloquentCollections = $collectionPost->loadMissing('category');

//        $eloquentCollections = $collectionPost->modelKeys();

//        $eloquentCollections = $collectionPost->makeVisible(['body']);
        return $request->all();

        $post = Post::first();
        $post->category->title = 1;

        $post->category->title == 1 ? $post->update(['']): null;


//        if ($post->category->title) echo 111;
//        else return 222;

        if (empty($post->category->title)) echo 123;
        else echo 222;
//        $post = $post->category->title ? 1:2;

//        dump($post, $b);

        return $post;

        $eloquentCollections = $collectionPost->makeHidden(['created_at', 'updated_at']);
        dump($eloquentCollections);
        return $eloquentCollections;
    }

    public function relationship()
    {
//        $first = OneToOneFirst::with('second')->find(1);
//        dump($first);
//        $first->delete();

//        $second = OneToOneSecond::with('first')->find(1);
//        dump($second);
//        $second->delete();


//        $first = OneToManyFirst::with('second')->find(1);
//        dump($first);
//        $first->second()->delete();
//        $first->delete();

//        $second = OneToManySecond::with('first')->find(1);
//        dump($second);


//        $first = ManyToManyFirst::find(1);
//        dump($first->second);
        $second = ManyToManySecond::find(1);
        dump($second->first);

//        Schema::dropIfExists('one_to_one_first');
    }
}
