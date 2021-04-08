<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');
        $response->assertSee('Adventure, Drama, Mystery, Science Fiction, Thriller');
        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
    }
    /** @test */
    public function the_movie_page_shows_the_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie(),
        ]);

        $response = $this->get(route('movies.show', 458576));
        $response->assertSee('Monster Hunter');
        $response->assertSee('Paul W. S. Anderson');
        $response->assertSee('Screenplay');
        $response->assertSee('Tony Jaa');
    }
    /** @test */
    public function the_search_dropdown_shows_works_correctly()
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?=Monster Hunter' => $this->fakeSearchMovies(),
        ]);

        Livewire::test('search-dropdown')
            ->assertDontSee('Monster Hunter')
            ->set('search', 'Monster Hunter')
            ->assertSee('Monster Hunter');
    }
    private function fakeSearchMovies()
    {
        return Http::response([
            "results" => [
                [
                    "backdrop_path" => "/8tNX8s3j1O0eqilOQkuroRLyOZA.jpg",
                    "genre_ids" =>[
                        14,
                        28,
                        12
                    ],
                    "id"=> 458576,
                    "original_language"=> "en",
                    "original_title"=> "Monster Hunter",
                    "overview"=> "Monster Hunter description. A portal transports Cpt. Artemis and an elite unit of soldiers to a strange world where powerful monsters rule with deadly ferocity. Faced with relentless danger, the team encounters a mysterious hunter who may be their only hope to find a way home.",
                    "popularity"=> 3434.38,
                    "poster_path"=> "/1UCOF11QCw8kcqvce8LKOO6pimh.jpg",
                    "release_date"=> "2020-12-03",
                    "title"=> "Monster Hunter",
                    "video"=> false,
                    "vote_average"=> 7.3,
                    "vote_count"=> 1009
                ]
            ]
        ], 200);

    }

    private function fakePopularMovies()
    {
        return Http::response([
            "results" => [
                [
                    "adult" => false,
                    "backdrop_path" => "/7KL4yJ4JsbtS1BNRilUApLvMnc5.jpg",
                    "genre_ids" => [
                        12,
                        18,
                        9648,
                        878,
                        53,
                    ],
                    "id" => 649087,
                    "original_language" => "sv",
                    "original_title" => "Fake Movie",
                    "overview" => "Fake Movie description. On a hiking trip to rekindle their marriage, a couple find themselves fleeing for their lives in the unforgiving wilderness from an unknown shooter.",
                    "popularity" => 2261.981,
                    "poster_path" => "/xZ2KER2gOHbuHP2GJoODuXDSZCb.jpg",
                    "release_date" => "2021-02-11",
                    "title" => "Fake Movie",
                    "video" => false,
                    "vote_average" => 6.6,
                    "vote_count" => 272,
                ]
            ]
        ], 200);
    }

    private function fakeNowPlayingMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 406.677,
                    "vote_count" => 2607,
                    "video" => false,
                    "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "Now Playing Fake Movie",
                    "genre_ids" => [
                        12,
                        18,
                        9648,
                        878,
                        53,
                    ],
                    "title" => "Now Playing Fake Movie",
                    "vote_average" => 6,
                    "overview" => "Now playing fake movie description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                    "release_date" => "2019-09-17",
                ]
            ]
        ], 200);
    }

    public function fakeGenres()
    {
        return Http::response([
            'genres' => [
                [
                    "id" => 28,
                    "name" => "Action"
                ],
                [
                    "id" => 12,
                    "name" => "Adventure"
                ],
                [
                    "id" => 16,
                    "name" => "Animation"
                ],
                [
                    "id" => 35,
                    "name" => "Comedy"
                ],
                [
                    "id" => 80,
                    "name" => "Crime"
                ],
                [
                    "id" => 99,
                    "name" => "Documentary"
                ],
                [
                    "id" => 18,
                    "name" => "Drama"
                ],
                [
                    "id" => 10751,
                    "name" => "Family"
                ],
                [
                    "id" => 14,
                    "name" => "Fantasy"
                ],
                [
                    "id" => 36,
                    "name" => "History"
                ],
                [
                    "id" => 27,
                    "name" => "Horror"
                ],
                [
                    "id" => 10402,
                    "name" => "Music"
                ],
                [
                    "id" => 9648,
                    "name" => "Mystery"
                ],
                [
                    "id" => 10749,
                    "name" => "Romance"
                ],
                [
                    "id" => 878,
                    "name" => "Science Fiction"
                ],
                [
                    "id" => 10770,
                    "name" => "TV Movie"
                ],
                [
                    "id" => 53,
                    "name" => "Thriller"
                ],
                [
                    "id" => 10752,
                    "name" => "War"
                ],
                [
                    "id" => 37,
                    "name" => "Western"
                ],
            ]
        ], 200);
    }

    public function fakeSingleMovie()
    {
        return Http::response([
            "adult" => false,
            "backdrop_path" => "/8tNX8s3j1O0eqilOQkuroRLyOZA.jpg",
            "genres" =>  [
              [ "id" => 14, "name" => "Fantasy" ],
              [ "id" => 28, "name" => "Action" ],
              [ "id" => 12, "name" => "Adventure" ],
            ],
            "homepage" => "https://www.monsterhunter.movie",
            "id" => 458576,
            "original_language" => "en",
            "original_title" => "Monster Hunter",
            "overview" => "A portal transports Cpt. Artemis and an elite unit of soldiers to a strange world where powerful monsters rule with deadly ferocity. Faced with relentless dange ",
            "popularity" => 2829.574,
            "poster_path" => "/1UCOF11QCw8kcqvce8LKOO6pimh.jpg",
            "release_date" => "2020-12-03",
            "revenue" => 25814306,
            "runtime" => 104,
            "status" => "Released",
            "tagline" => "Behind our world, there is another.",
            "title" => "Monster Hunter",
            "video" => false,
            "vote_average" => 7.3,
            "vote_count" => 974,
            "credits" => [
                "cast" => [
                    [
                        "gender" => 2,
                        "id" => 57207,
                        "known_for_department" => "Acting",
                        "name" => "Tony Jaa",
                        "original_name" => "Tony Jaa",
                        "popularity" => 7.261,
                        "profile_path" => "/anBSs0nh4n4cpiwRl5QmjT5zRrt.jpg",
                        "cast_id" => 7,
                        "character" => "The Hunter",
                        "credit_id" => "5bc052b292514179ae01179c",
                        "order" => 1,
                    ]
                ],
                "crew" => [
                    [
                        "gender" => 2,
                        "id" => 4014,
                        "name" => "Paul W. S. Anderson",
                        "profile_path" => "/AeYYSi30WCkowdk04Awa0kr1E4S.jpg",
                        "credit_id" => "5921e2aa925141482f05c79a",
                        "department" => "Writing",
                        "job" => "Screenplay",
                    ]
                ]
            ],
            "videos" => [
                "results" => [
                    [
                        "id" => "5f88af92e33f83003afe82e9",
                        "iso_639_1" => "en",
                        "iso_3166_1" => "US",
                        "key" => "3od-kQMTZ9M",
                        "name" => "MONSTER HUNTER - Official Trailer (HD)",
                        "site" => "YouTube",
                        "size" => 1080,
                        "type" => "Trailer",
                    ]
                ]
            ],
            "images" => [
                    "backdrops" => [
                        [
                            "aspect_ratio" => 1.7777777777778,
                            "file_path" => "/8tNX8s3j1O0eqilOQkuroRLyOZA.jpg",
                            "height" => 1080,
                            "iso_639_1" => null,
                            "vote_average" => 5.456,
                            "vote_count" => 5,
                            "width" => 1920,
                        ]
                    ],
                    "posters" => [
                        [

                        ]
                    ]
                ]
            ], 200);
    }
}
